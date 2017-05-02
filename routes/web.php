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
    Route::get('/list/{option}', 'ArticleController@getList');
    Route::post('/store', 'ArticleController@store');
    Route::post('/update', 'ArticleController@update');
    Route::post('/destroy', 'ArticleController@destroy');
});
//Route slider
Route::group(['prefix' => '/slider'], function () {
    Route::get('/', 'SliderController@view');
    Route::get('/get', 'SliderController@get');
    Route::post('/store', 'SliderController@store');
    Route::post('/update', 'SliderController@update');
    Route::post('/destroy', 'SliderController@destroy');
});