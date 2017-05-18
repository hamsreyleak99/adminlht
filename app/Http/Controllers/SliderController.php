<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;
use Validator;

class SliderController extends Controller
{
    /**
     *The information we send to the view
     *@var array
     */
        protected $data = []; 
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {

<<<<<<< .mine
        $article = new Article();

        // $this->data['articleDate'] = $article->get()->content();
 
         $articlecontroller 		= 	new ArticleController;
		$this->data['article'] 	= 	$articlecontroller->getList('all')->content();
		
        return view('pages.slider',$this->data);
    }
    /**
	 * Get a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get()
	{
		$sliders = Slider::all()->sortByDesc('id')->values()->all();
=======
        $this->data['datas'] = Slider::all()->sortByDesc('id')->values()->all();
















>>>>>>> .theirs

        $article= new Article();
        $this->data['articles']=$article->get();

        return view('pages.slides.slide', $this->data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
            validation image;
         */
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slide = new Slider();

        $slide->article_id 	= $request->article_id;
        $slide->name 		= $request->name;

        if($request->hasFile('image')){
            if($validator->passes()){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                $slide->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $slide->description 	= $request->description;
        $slide->status 		    = $request->status;
        $slide->created_by 	    = auth::id();
        $slide->updated_by 	    = auth::id();
        $slide->save(); 
        return redirect('/slide'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($slide_id)
    {
        $slide = Slider::find($slide_id);
        return Response()->json($slide);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slide_id)
    {
        
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

        $slide               = Slider::find($slide_id);
        $slide->article_id   = $request->article_id;
        $slide->name         = $request->name;

        if($request->hasFile('image')){
            if($validator->passes()){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 300)->save( public_path('/uploads/images/' . $filename ) );

                $slide->image = $filename;
            }else{
                return Response()->json(['error'=>$validator->errors()->all()]);
            }
        }

        $slide->description 	= $request->description;
        $slide->status 		    = $request->status;
        $slide->updated_by 	    = auth::id();
        $slide->save();
        return redirect('/slide'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slide_id)
    {

        $slide = Slider::destroy($slide_id);
        return response()->json($slide);

    }
}
