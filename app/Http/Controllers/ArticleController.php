<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
	 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $datas = Article::all()->sortByDesc('id')->values()->all();
       
        return view('pages.articles.article', array('datas' => $datas ));
        //return view('pages.articles.test', array('datas' => $datas ));
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
    public function destroy($id)
    {

        $article = article::destroy($id);
        return response()->json($article);

    }
	
}
