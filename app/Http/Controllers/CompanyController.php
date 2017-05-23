<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Controllers\Helpers\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Image;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        // check Language
        Language::checkLang($request->lang);
        // get Language
        $lang = Language::getTitleLang();

        $company = new Company();

        $datas = $company->where('lang', '=', $lang)->orderBy('created_at', 'desc')->paginate(10);

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

        

        $listLang = config('app.locales');
        $id_table = Company::max('id_table')+1;

        foreach ($listLang as $key => $value) {
           $company = new Company();


            

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
            $company->id_table          = $id_table;
            $company->company_name      = $request->company_name;
            $company->description       = $request->description;
            $company->status            = $request->status;
            $company->lang              = $key;
            $company->created_by        = auth::id();
            $company->updated_by        = auth::id();
            $company->save();
        }

       
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
    public function destroy($company_id)
    {

        $company = new Company();
        $company->where('id_table', '=', $company_id)->delete();
        return response()->json($company);

    }
}
