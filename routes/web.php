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

Route::get('/profile', 'ProfileController@index');

Route::get('/events', 'EventController@events');

Route::get('/product_by_category/{id}', 'ProductController@product_by_category');

Route::get('/event/{id}', 'EventController@event_by_id');

Route::resource('/comments', 'CommentController');

Route::resource('/attend', 'AttendController');

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function(){

    Route::resource('/events', 'EventController');

    Route::resource('/profile', 'UserController');

    Route::resource('/products', 'ProductController');

    Route::get('/dashboard', 'DashboardController@index');

});
