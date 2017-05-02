<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', function () {
	if (Auth::check()) 
    {
    	return redirect('/dashboard');
    }else{
    	return redirect('/login');
    }    
});


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Route article
Route::group(['prefix' => '/article'], function () {
    Route::get('/', 'ArticleController@view');
    Route::get('/get', 'ArticleController@get');
    Route::post('/store', 'ArticleController@store');
    Route::post('/update', 'ArticleController@update');
    Route::post('/destroy', 'ArticleController@destroy');
});
Route::get('/article', 'ArticleController@view');


Route::group(['prefix' => '/employee'], function(){
	Route::get('/', 'EmployeeController@view');
	Route::get('/get', 'EmployeeController@get');
	Route::post('/post', 'EmployeeController@store');
	Route::post('/update', 'EmployeeController@update');
	Route::post('/destroy', 'EmployeeController@destroy');
});
