<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 Route::get('get-profile', 'ProfileController@post_profile')->middleware('auth:api');



Route::post('register', 'Auth\AuthController@register');
Route::post('login', 'Auth\AuthController@login');


Route::post('forgot-password', 'Auth\AuthController@forgotpassword')->name('password.reset');
Route::post('reset-password', 'Auth\AuthController@resetpassword');


Route::get('user', 'UserController@get_profile');



