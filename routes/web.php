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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/events', 'EventController@events');

Route::get('/event/{id}', 'EventController@event_by_id');

Route::resource('/comments', 'EventController');

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function(){

    Route::resource('/events', 'EventController');

    Route::resource('/profile', 'UserController');

    Route::get('/', 'DashboardController@index');

    // Route::get('/profile', 'UserController@index');

    // Route::post('/profile/{id}', 'UserController@update');

});
