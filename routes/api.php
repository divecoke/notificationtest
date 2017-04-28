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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('add', ['uses' => 'UserController@add']);
        Route::put('update', ['uses' => 'UserController@update']);
        Route::get('all', ['uses' => 'UserController@all']);
        Route::get('single/{id}', ['uses' => 'UserController@single']);
        Route::delete('destroy', ['uses' => 'UserController@destroy']);
    });
    //Antra elutes
});
