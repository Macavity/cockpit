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

Route::group([
    'namespace' => 'App\Http\Controllers\Api'
], function () {

    // JWT Authentication
    Route::post('authenticate', 'ApiController@authenticate');
    Route::post('logout', 'ApiController@logout');
    Route::post('token', 'ApiController@getToken');

    // Protected Routes
    Route::group([
        'middleware' => 'auth:api'
    ], function () {

        Route::get('/users', 'UserController@index');
        Route::post('/users', 'UserController@create');
        Route::get('/users/me', 'UserController@getCurrentUser');
        Route::get('/users/{uuid}', 'UserController@show');
        Route::put('/users/{uuid}', 'UserController@update');


    });

});
