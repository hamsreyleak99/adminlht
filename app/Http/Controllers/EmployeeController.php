<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Controllers\ArticleController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->data['articles']         =   $articleController->get()->content();

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
        $employeesRequest = json_decode($request->input('employee'));

        foreach ($employeesRequest as $key => $employeeRequest) {
            try {

                $employeeObject = new Employee();

                $employeeObject->article_id         =   $employeeRequest->article_id;
                $employeeObject->firstName          =   $employeeRequest->firstName;
                $employeeObject->lastName           =   $employeeRequest->lastName;
                // $employeeObject->image              =   $employeeRequest->image;
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
        $employeesRequest = json_decode($request->input('employee'));

        foreach ($employeesRequest as $key => $employeeRequest) {
            try {

                $employeeObject = Employee::findOrFail($employeeRequest->id);

                $employeeObject->article_id         =   $employeeRequest->article_id;
                $employeeObject->firstName          =   $employeeRequest->firstName;
                $employeeObject->lastName           =   $employeeRequest->lastName;
                // $employeeObject->image              =   $employeeRequest->image;
                $employeeObject->phone              =   $employeeRequest->phone;
                $employeeObject->email              =   $employeeRequest->email;
                $employeeObject->address            =   $employeeRequest->address;
                $employeeObject->detial             =   $employeeRequest->detial;
                $employeeObject->status             =   $employeeRequest->status;
                $employeeObject->created_by         =   auth::id();

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
        $employeesRequest = json_decode($request->input('employee'));

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
