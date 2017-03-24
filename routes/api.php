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

Route::group(['prefix' => 'v1'], function() {
    //Users
    Route::group(['prefix' => 'users', 'middleware' => 'cors'], function () {
        Route::get(null, 'User\UserController@index');
        Route::get('{id}', 'User\UserController@show');
        Route::post(null, 'User\UserController@store');
        Route::put('{id}', 'User\UserController@update');
        Route::delete('{id}', 'User\UserController@destroy');
        Route::get('work/{id}', 'User\UserController@getUserByWork');
    });
    //Works
    Route::group(['prefix' => 'works', 'middleware' => ['cors', 'jwt.auth']], function () {
        Route::get(null, 'Work\WorkController@index');
        Route::get('{id}', 'Work\WorkController@show');
        Route::post(null, 'Work\WorkController@store');
        Route::put('{id}', 'Work\WorkController@update');
        Route::delete('{id}', 'Work\WorkController@destroy');
        Route::get('user/{id}', 'Work\WorkController@getWorksByUser');
    });
    //Auth
    Route::post('authorize', 'Auth\AuthController@authenticate');
});
