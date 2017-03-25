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
        Route::get('construction/{id}', 'User\UserController@getUserByConstruction');
    });
    //Works
    Route::group(['prefix' => 'constructions', 'middleware' => ['cors'/*, 'JWT.auth'*/]], function () {
        Route::get(null, 'Construction\ConstructionController@index');
        Route::get('{id}', 'Construction\ConstructionController@show');
        Route::post(null, 'Construction\ConstructionController@store');
        Route::put('{id}', 'Construction\ConstructionController@update');
        Route::delete('{id}', 'Construction\ConstructionController@destroy');
        Route::get('user/{id}', 'Construction\ConstructionController@getConstructionsByUser');
    });
    //Auth
    Route::post('authorize', 'Auth\AuthController@authenticate');
});
