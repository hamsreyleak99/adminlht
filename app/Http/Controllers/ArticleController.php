<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
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
        // get title lang
        $lang = Language::getTitleLang();

        $article = new Article();
        $datas = $article->where('lang', '=', $lang)->paginate(10);
       
        return view('pages.articles.article', array('datas' => $datas ));
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $article = new Article();

        $article->name 			= $request->name;
        $article->description 	= $request->description;
        $article->status 		= $request->status;
        $article->created_by 	= auth::id();
        $article->updated_by 	= auth::id();
        $article->save();
        return redirect('/article'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $article = Article::find($id);
        return Response()->json($article);  
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
        $article = Article::find($id);
        $article->name 			= $request->name;
        $article->description 	= $request->description;
        $article->status 		= $request->status;
        $article->updated_by 	= auth::id();
        $article->save();
        return redirect('/article'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {

    //     $article = article::destroy($id);
    //     return response()->json($article);

    // }
	
}
