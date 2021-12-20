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

Auth::routes();
Route::group(['prefix' => 'v2'], function () {
    Route::post('login', 'ApiController@login');
    Route::post('register', 'ApiController@register');
   
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('changepassword','ApiController@changepassword');
        Route::get('profile','ApiController@profile');
        Route::post('updateprofile','ApiController@updateprofile');
        Route::get('logout', 'ApiController@logout');
        
        Route::get('boards','ApiController@boards');
        Route::post('addboard','ApiController@addboard');
        Route::post('editboard','ApiController@editboard');
        Route::post('deleteboard','ApiController@deleteboard');
        
        Route::get('tasks','ApiController@tasks');
        Route::post('addtask','ApiController@addtask');
        Route::post('edittask','ApiController@edittask');
        Route::post('deletetask','ApiController@deletetask');
        
        Route::post('addassignment','ApiController@addassignment');
        Route::post('editassignment','ApiController@editassignment');
        Route::post('deleteassignment','ApiController@deleteassignment');
        
        Route::get('wallets','ApiController@wallets');
        Route::post('addwallet','ApiController@addwallet');
        Route::post('editwallet','ApiController@editwallet');
        Route::post('deletewallet','ApiController@deletewallet');
        
    });
});


