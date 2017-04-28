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
        Route::post('userexist', ['uses' => 'UserController@ifUserExists']);
    });

    Route::group(['prefix' => 'group'], function () {
        Route::post('add', ['uses' => 'GroupController@add']);
        Route::put('update', ['uses' => 'GroupController@update']);
        Route::get('all', ['uses' => 'GroupController@all']);
        Route::get('single/{id}', ['uses' => 'GroupController@single']);
        Route::delete('destroy', ['uses' => 'GroupController@destroy']);
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::post('add', ['uses' => 'NotificationController@add']);
        Route::put('update', ['uses' => 'NotificationController@update']);
        Route::get('get_to_group', ['uses' => 'NotificationController@get_from_groups']);
        Route::get('single/{id}', ['uses' => 'NotificationController@single']);
        Route::delete('destroy', ['uses' => 'NotificationController@destroy']);
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('all', ['uses' => 'RolesController@all']);
    });
});
