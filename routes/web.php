<?php

use App\Http\Controllers\frontend\HomeController;

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


Route::get('/admin', function () {
	if (Auth::check()) 
    {
    	return redirect('/dashboard');
    }else{
    	return redirect('/admin/login');
    }    
});


Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

// ==================================================
                // Route Backend

//Route article
Route::group(['prefix' => '/article'], function () {
    Route::get('/', 'ArticleController@view');
    Route::get('/{id?}', 'ArticleController@get');
    Route::post('/', 'ArticleController@store');
    Route::post('/{id?}', 'ArticleController@update');
    // Route::delete('/{id?}', 'ArticleController@destroy'); 
});
//Route slider
Route::group(['prefix' => '/slide'], function () {
    Route::get('/', 'SliderController@view');
    Route::get('/{slide_id?}', 'SliderController@get');
    Route::post('/', 'SliderController@store');
    Route::post('/{slide_id?}', 'SliderController@update');
    Route::delete('/{slide_id?}', 'SliderController@destroy'); 
});

//Route company 
Route::group(['prefix' => '/company'], function () {
    Route::get('/', 'CompanyController@view');
    Route::get('/{id?}', 'CompanyController@get');
    Route::post('/', 'CompanyController@store');
    Route::post('/{id?}', 'CompanyController@update');
    Route::delete('/{id?}', 'CompanyController@destroy'); 
});

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
    Route::get('/{career_id?}', 'CareerController@edit');
    Route::post('/', 'CareerController@store');
    Route::post('/{career_id?}', 'CareerController@update');
    Route::delete('/{career_id?}', 'CareerController@destroy');
});

//Route Event
Route::group(['prefix' => '/event'], function(){
    Route::get('/', 'EventController@view');
    Route::get('/{event_id?}', 'EventController@edit');
    Route::post('/', 'EventController@store');
    Route::post('/{event_id?}', 'EventController@update');
    Route::delete('/{event_id?}', 'EventController@destroy');
});

// ========================================================================

            // Route FrontEnd
    
    // Route Home
    Route::get('/', 'frontend\HomeController@getIndex');

    // Route About
    
    Route::get('/about', function(){
        return view('FrontEnd/pages/about');
    });
    
    // Route Company
    
    Route::get('/group-company', function(){
        return view('FrontEnd/pages/company');
    });

    // Route Team
    // 
    Route::get('/team', function(){
        return view('FrontEnd/pages/team');
    });

    // Route Event
    
    Route::get('/event-frontend', function(){
        return view('FrontEnd/pages/event');
    });

    // Route Trading
    
    Route::get('/trading', function(){
        return view('FrontEnd.pages.trading');
    });

    // Route Career
    
    Route::get('/career-frontend', function(){
        return view ('FrontEnd/pages/career');
    });

    // Route Contact Us
    
    Route::get('/contact', function(){
        return view('FrontEnd/pages/contact');
    });