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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index');
// Route::get('/article', 'ArticleController@view');
// //Route customer
// Route::group(['prefix' => '/article'], function () {
//     // Route::get('/', 'CustomerController@view');
//     // Route::get('/get', 'CustomerController@get');
//     // Route::post('/store', 'CustomerController@store');
//     // Route::post('/update', 'CustomerController@update');
//     // Route::post('/destroy', 'CustomerController@destroy');
// });

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
Route::get('/article', 'ArticleController@view');