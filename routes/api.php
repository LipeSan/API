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
    Route::group(['prefix' => 'constructions', 'middleware' => ['cors', 'JWT.auth']], function () {
        Route::get(null, 'Construction\ConstructionController@index');
        Route::get('pagination/{limit}', 'Construction\ConstructionController@pagination');
        Route::get('{id}', 'Construction\ConstructionController@show');
        Route::post(null, 'Construction\ConstructionController@store');
        Route::put('{id}', 'Construction\ConstructionController@update');
        Route::delete('{id}', 'Construction\ConstructionController@destroy');
        Route::post('add/kit', 'Construction\ConstructionController@addKit');
        Route::delete('remove/kit', 'Construction\ConstructionController@removeKit');
        Route::post('sync/kits', 'Construction\ConstructionController@syncKits');
        Route::get('user/{id}', 'Construction\ConstructionController@getConstructionsByUser');
        Route::get('{id}/kits', 'Construction\ConstructionController@getKitsByConstruction');
    });
    //Kit
    Route::group(['prefix' => 'kits', 'middleware' => ['cors', 'JWT.auth']], function () {
        Route::get(null, 'Kit\KitController@index');
        Route::get('{id}', 'Kit\KitController@show');
        Route::post(null, 'Kit\KitController@store');
        Route::put('{id}', 'Kit\KitController@update');
        Route::delete('{id}', 'Kit\KitController@destroy');
        Route::get('{id}/constructions', 'Kit\KitController@getConstructionsByKit');
    });
    //Auth
    Route::post('authorize', 'Auth\AuthController@authenticate');
    Route::post('refresh', 'Auth\AuthController@refreshToken');
});
