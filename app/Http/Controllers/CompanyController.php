<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
  
        $datas = Company::all()->sortByDesc('id')->values()->all();

        return view('pages.company.company', array('datas' => $datas ));
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $company = new Company();

        $company->company_name = $request->company_name;

        if($request->hasFile('image')){
            if($validator->passes()){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                $company->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $company->description 		= $request->description;
        $company->status 			= $request->status;
        $company->created_by 		= auth::id();
        $company->updated_by 		= auth::id();
        $company->save();
        return redirect('/company'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $company = Company::find($id);
        return Response()->json($company);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

        $company 				= Company::find($id);
        $company->company_name 	= $request->company_name;

        if($request->hasFile('image')){
            if($validator->passes()){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                $company->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $company->description 	= $request->description;
        $company->status 		= $request->status;
        $company->updated_by 	= auth::id();
        $company->save();
        return redirect('/company'); 


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {

        $company = company::destroy($id);
        return response()->json($company);

    }
}
