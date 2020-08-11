<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::prefix('auth')->namespace('Api')->group(function () {
//    Route::post('register', 'AuthController@register');
//    Route::post('login', 'AuthController@login');
//    Route::get('refresh', 'AuthController@refresh');
//    Route::get('social/{provider}', 'AuthController@redirectToProvider');
//    Route::get('social/callback/{provider}', 'AuthController@handleProviderCallback');
//
//    Route::middleware('auth:api')->group(function () {
//        Route::get('user', 'AuthController@user');
//        Route::post('logout', 'AuthController@logout');
//    });
//});
//Route::apiResource('users', 'Api\UserController')->middleware(['auth:api']);
//Route::get('social-user/{token}', 'Api\UserController@socialUser');
//Route::post('password/reset', 'Api\UserController@resetPassword');
//Route::get('/home/links', 'HomeController@links');
//Route::get('/home/test', 'HomeController@test');

//Route::post('/notification/new-contact-us','Api\NotificationController@contactUs');

Route::group(['prefix' => 'v1','namespace' => '\App\Rest\version\v1'], function() {

    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('refresh', 'AuthController@refresh');

        Route::get('social/{provider}', 'AuthController@redirectToProvider');
        Route::get('social/callback/{provider}', 'AuthController@handleProviderCallback');
    });

    Route::get('social-user/{token}', 'UserController@socialUser');
    Route::post('password/reset', 'UserController@resetPassword');
    Route::get("/notifications/contact-us/",'NotificationController@getContacts');
    Route::group(['middleware'=>['auth:api']], function() {
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');

        Route::apiResource('users', 'UserController');
        Route::apiResource('messages', 'MessagesController');
        Route::get('messages/specific-user/{user}','MessagesController@messages');
        Route::post('/notification/new-contact-us','NotificationController@putContact');
    });
});

