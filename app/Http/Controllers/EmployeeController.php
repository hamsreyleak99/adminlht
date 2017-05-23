<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Controllers\Helpers\Language;
use Illuminate\Database\Eloquent\Relations\paginate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\validate;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        // check language
        Language::checkLang($request->lang);
        // get language
        $lang = Language::getTitleLang();
        
        $employee = new Employee();

        $datas = $employee->where('lang', '=', $lang)->orderBy('created_at', 'desc')->paginate(10);
        
        return view('pages.employees.employee', array('datas' => $datas ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /*validation image*/
         
        $validator = Validator::make($request->all(), [
                // 'firstName' => 'required|min:2|max:35|alpha',
                // 'lastName' => 'required|min:2|max:35|alpha',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                // 'gender' => 'required',
                // 'phone' => 'min:9|max:20|numeric',
                // 'email' => 'email|unique:users',
                // 'address' => 'string|min:2',
                // 'description' => 'required',
        ]);

        
        $listLeng = config('app.locales');
        $id_table = Employee::max('id_table')+1;
        
        foreach ($listLeng as $key => $value) {

            if($validator->passes()){

                $employee = new Employee();

                $employee->id_table = $id_table;
                $employee->firstName = $request->firstName;
                $employee->lastName = $request->lastName;
                $employee->gender = $request->gender;

                if($request->hasFile('image')){
                    
                        $image = $request->file('image');
                        $filename = time() . '.' . $image->getClientOriginalExtension();
                        Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                        $employee->image = $filename;          
                }

                $employee->phone = $request->phone;
                $employee->email = $request->email;
                $employee->address = $request->address;
                $employee->detial = $request->detial;
                $employee->status = $request->status;
                $employee->lang = $key;
                $employee->created_by = auth::id();
                $employee->updated_by = auth::id();

                $employee->save();           
            }  
        }

         
        return redirect('/employee'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($employee_id)
    {
        $employee = Employee::find($employee_id);
        return Response()->json($employee);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee_id)
    {
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

        $employee = Employee::find($employee_id);
        $employee->firstName = $request->firstName;
        $employee->lastName = $request->lastName;
        $employee->gender = $request->gender;

        if($request->hasFile('image')){
            if($validator->passes()){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                $employee->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->address = $request->address;
        $employee->detial = $request->detial;
        $employee->status = $request->status;
        $employee->updated_by = auth::id();
        $employee->save();
        return redirect('/employee'); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {

        // $employee = Employee::destroy($employee_id);
        $employee = new Employee();
        $response =  $employee->where('id_table', '=', $employee_id)->delete();
        return response()->json($response);

    }
}
