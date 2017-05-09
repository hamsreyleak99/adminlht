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
    Route::get('/{id?}', 'ArticleController@get');
    Route::post('/', 'ArticleController@store');
    Route::post('/{id?}', 'ArticleController@update');
    Route::delete('/{id?}', 'ArticleController@destroy'); 
});
//Route slider
Route::group(['prefix' => '/slide'], function () {
    Route::get('/', 'SliderController@view');
    Route::get('/{slide_id?}', 'SliderController@get');
    Route::post('/', 'SliderController@store');
    Route::post('/{slide_id?}', 'SliderController@update');
    Route::delete('/{slide_id?}', 'SliderController@destroy'); 
});

// Route::group(['prefix' => '/slider'], function () {
//     Route::get('/', 'SliderController@view');
//     Route::get('/get', 'SliderController@get');
//     Route::post('/store', 'SliderController@store');
//     Route::post('/update', 'SliderController@update');
//     Route::post('/destroy', 'SliderController@destroy');
//     Route::post('/upload', 'SliderController@upload');
// });
// Route employee

Route::group(['prefix' => '/employee'], function () {
    Route::get('/', 'EmployeeController@view');
    Route::get('/{employee_id?}', 'EmployeeController@get');
    Route::post('/', 'EmployeeController@store');
    Route::post('/{employee_id?}', 'EmployeeController@update');
    Route::delete('/{employee_id?}', 'EmployeeController@destroy'); 
});
// Route career
Route::group(['prefix' => '/career'], function(){
    Route::get('/', 'CareerController@view');   
    Route::post('/', 'CareerController@store');
});