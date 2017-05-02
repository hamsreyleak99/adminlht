<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $this->data['title'] = 'Article';
        return view('pages.article',$this->data);
    }
    /**
	 * Get a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function get()
	{
		$articles = Article::get()->sortByDesc('id')->values()->all();

		return Response()->Json($articles);
	}
	/**
     * Get a listing of the resource that contains(value, text).
     *
     * @return \Illuminate\Http\Response
     */
    public function getList($option = null)
    {
        $articles = [];

        if($option == 'filter'){
            //Get all branch records filter status = enabled
            $articles = Article::where('status',Status::ENABLED)->whereIn('id',array_column(auth::user()->articles, 'value'))->get(['id as value','name as text'])->sortBy('text')->values()->all();
            
        }elseif ($option == 'all') {
            //Get all branch records
            $articles = Article::get(['id as value','name as text'])->sortBy('text')->values()->all(); 
        }
        
        return Response()->Json($articles);
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$articlesRequest = json_decode($request->input('article'));

		foreach ($articlesRequest as $key => $articleRequest) {
			try {

				$articleObject = new Article();

				$articleObject->name 				= 	$articleRequest->name;
				$articleObject->description 		= 	$articleRequest->description;
				$articleObject->status          	=   $articleRequest->status;
				$articleObject->created_by      	=   auth::id();
				$articleObject->updated_by      	=   auth::id();

				$articleObject->save();

				$articlesResponse[] = $articleObject;

			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($articlesResponse);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$articlesResponse = json_decode($request->input('article'));

		foreach ($articlesResponse as $key => $articleRequest) {
			try {

				$articleObject = Article::findOrFail($articleRequest->id);
				
				$articleObject->name 				= 	$articleRequest->name;
				$articleObject->description 		= 	$articleRequest->description;
				$articleObject->status          	=   $articleRequest->status;
				$articleObject->updated_by      	=   auth::id();

				$articleObject->save();

				$articlesResponse[] = $articleObject;
					
			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($articlesResponse);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		$articlesRequest = json_decode($request->input('article'));

		foreach ($articlesRequest as $key => $articleRequest) {
			try {

				$articleObject = Article::findOrFail($articleRequest->id);

				$articleObject->delete();

				$articlesResponse[] = $articleRequest;

					
			} catch (Exception $e) {
					
			}
		}

		return Response()->Json($articlesResponse);
	}
}
