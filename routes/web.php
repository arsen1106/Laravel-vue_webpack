<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->namespace('backend')->prefix('admin')->name('admin.')->group(function(){
    Route::get('/','DashboardController@index')->name('index');
    Route::get('/setting','SettingsController@index')->name('setting.index');
    Route::post('/setting/store','SettingsController@store')->name('setting.store');
    Route::post('/setting/setwebhook','SettingsController@setwebhook')->name('setting.setwebhook');
    Route::post('/setting/getwebhookinfo','SettingsController@getwebhookinfo')->name('setting.getwebhookinfo');
});
Route::post(Telegram::getAccessToken(),'Backend\TelegramController@webhook');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
