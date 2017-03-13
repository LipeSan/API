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

Route::get('/', function() {
    return '
        <p style="font-size: 20px">
                Api:
            <b style="color: red;">
                v1
            </b><br>
                Status:
            <b style="color: green;">
                connected
            </b>
        </p>
    ';
});

Route::group(['prefix' => 'api/v1'], function() {
    //Users
    Route::group(['prefix' => 'users'], function () {
        Route::get(null, 'User\UserController@index');
        Route::get('{id}', 'User\UserController@show');
        Route::post(null, 'User\UserController@store');
        Route::put('{id}', 'User\UserController@update');
        Route::delete('{id}', 'User\UserController@destroy');
    });
    //Auth
    Route::post('login', 'AuthController@authenticate');
});
