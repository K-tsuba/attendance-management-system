<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function() {
//     return view('times/index');
// });

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'TimeController@index');
    Route::get('/times/show', 'TimeController@show');
    Route::post('/times/start_store', 'TimeController@start_store');
    Route::post('/times/stop_store', 'TimeController@stop_store');
    Route::post('/times/rest_start', 'TimeController@rest_start_store');
    Route::post('/times/rest_stop', 'TimeController@rest_stop_store');
    Route::get('/users/index', 'UserController@index');    
    Route::get('/linelogin', 'LineLoginController@lineLogin')->name('linelogin');
    Route::get('/callback', 'LineLoginController@callback')->name('callback');    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


