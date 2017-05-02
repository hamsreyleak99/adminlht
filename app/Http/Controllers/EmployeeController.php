<?php

namespace App\Http\Controllers;

use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     *The information we send to the view
     *@var array
     */
        protected $data = []; 
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $this->data['title']            =   'Employee List';

        $articleController              =   new ArticleController;
        $this->data['articles']         =   $articleController->getList('all')->content();

        return view('pages.employee', $this->data);
    }

    /**
     * Get a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $employees = Employee::all()->sortByDesc('id')->values()->all();

        return Response()->Json($employees);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employeesRequest = json_decode($request->input('employees'));

        foreach ($employeesRequest as $key => $employeeRequest) {
            try {

                $employeeObject = new Employee();

                $employeeObject->article_id         =   $employeeRequest->article_id;
                $employeeObject->firstName          =   $employeeRequest->firstName;
                $employeeObject->lastName           =   $employeeRequest->lastName;
                $employeeObject->image              =   $employeeRequest->image;
                $employeeObject->phone              =   $employeeRequest->phone;
                $employeeObject->email              =   $employeeRequest->email;
                $employeeObject->address            =   $employeeRequest->address;
                $employeeObject->detial             =   $employeeRequest->detial;
                $employeeObject->status             =   $employeeRequest->status;
                $employeeObject->created_by         =   auth::id();
                $employeeObject->updated_by         =   auth::id();

                $employeeObject->save();

                $employeesResponse[] = $employeeObject;

            } catch (Exception $e) {
                    
            }
        }

        return Response()->Json($employeesResponse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $employeesRequest = json_decode($request->input('employees'));

        foreach ($employeesRequest as $key => $employeeRequest) {
            try {

                $employeeObject = Employee::findOrFail($employeeRequest->id);

                $employeeObject->identity_card      =   $employeeRequest->identity_card;
                $employeeObject->first_name         =   $employeeRequest->first_name;
                $employeeObject->last_name          =   $employeeRequest->last_name;
                $employeeObject->job_title          =   $employeeRequest->job_title;
                $employeeObject->employee_type_id   =   $employeeRequest->employee_type_id;
                $employeeObject->gender             =   $employeeRequest->gender;
                $employeeObject->date_of_birth      =   Carbon::parse($employeeRequest->date_of_birth)->addDay();
                $employeeObject->start_work         =   is_null($employeeRequest->start_work) ? 
                                                        $employeeRequest->start_work : 
                                                        Carbon::parse($employeeRequest->start_work)->addDay();
                $employeeObject->end_work           =   is_null($employeeRequest->end_work) ? 
                                                        $employeeRequest->end_work : 
                                                        Carbon::parse($employeeRequest->end_work)->addDay();
                $employeeObject->start_contract     =   is_null($employeeRequest->start_contract) ? 
                                                        $employeeRequest->start_contract : 
                                                        Carbon::parse($employeeRequest->start_contract)->addDay();
                $employeeObject->end_contract       =   is_null($employeeRequest->end_contract) ? 
                                                        $employeeRequest->end_contract : 
                                                        Carbon::parse($employeeRequest->end_contract)->addDay();
                $employeeObject->spouse             =   $employeeRequest->spouse;
                $employeeObject->minor              =   $employeeRequest->minor;
                $employeeObject->phone              =   $employeeRequest->phone;
                $employeeObject->email              =   $employeeRequest->email;
                $employeeObject->country_id         =   $employeeRequest->country_id;
                $employeeObject->city_id            =   $employeeRequest->city_id;
                $employeeObject->region             =   $employeeRequest->region;
                $employeeObject->postal_code        =   $employeeRequest->postal_code;
                $employeeObject->address            =   $employeeRequest->address;
                $employeeObject->detail             =   $employeeRequest->detail;
                $employeeObject->branch_id          =   $employeeRequest->branch_id;
                $employeeObject->status             =   $employeeRequest->status;
                $employeeObject->updated_by         =   auth::id();

                $employeeObject->save();

                $employeesResponse[] = $employeeObject;
                    
            } catch (Exception $e) {
                    
            }
        }

        return Response()->Json($employeesResponse);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employeesRequest = json_decode($request->input('employees'));

        foreach ($employeesRequest as $key => $employeeRequest) {
            try {

                $employeeObject = Employee::findOrFail($employeeRequest->id);

                $employeeObject->delete();

                $employeesResponse[] = $employeeRequest;
                    
            } catch (Exception $e) {
                    
            }
        }

        return Response()->Json($employeesResponse);
    }
}
