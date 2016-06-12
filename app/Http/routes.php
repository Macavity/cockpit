<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Not logged in (Welcome)
Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);

// Authentication Routes
Route::auth();

Route::group([
        'middleware' => ['web','auth'],
        'prefix' => '/'
    ], function() {

    // Dashboard
    Route::get('dashboard', [
        'uses' => 'AngularRouteController@index',
        'as' => 'dashboard'
    ]);


});

// Route for frontend requests
Route::group([
    'middleware' => ['auth'],
    'prefix' => '/api/'
], function() {

    Route::get('dashboard', [
        'uses' => 'DashboardController@statistics',
        'as' => 'dashboard'
    ]);

    // Upload file
    Route::post('upload-file', 'UploadController@uploadFile');

});


// Angular 2 templates route
Route::get('/templates/{template}', 'AngularTemplateController@index');




/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
