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

Route::get('/profile_search', 'ProfileController@profile_search');

Route::get('/send_friend_request/{id}', 'ProfileController@send_friend_request');

Route::get('/profile_search_selected', 'ProfileController@profile_search_selected')->name('profile_search_selected');

Route::get('/profile/{id}', 'ProfileController@profile_by_user_id');

Route::post('/send_email', 'ProductController@send_email')->name('send_email');

Route::get('/events', 'EventController@events');

Route::post('/attend_event', 'EventController@attend_event')->name('event.attend');

Route::post('/unattend_event/{id}', 'EventController@unattend_event')->name('event.unattend');

Route::get('/product_by_category/{id}', 'ProductController@product_by_category');

Route::get('/product/{id}', 'ProductController@product');

Route::get('/event/{id}', 'EventController@event_by_id');

Route::resource('/comments', 'CommentController');

Route::get('/logout', 'Auth\LoginController@logout');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function(){

    Route::resource('/events', 'EventController');

    Route::resource('/profile', 'UserController');

    Route::resource('/products', 'ProductController');

    Route::get('/friends', 'UserController@friends');

    Route::get('/unfriend/{id}', 'UserController@unfriend');

    Route::get('/dashboard', 'DashboardController@index');

});
