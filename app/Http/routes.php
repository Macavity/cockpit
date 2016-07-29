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

/**
 * API Routes
 * https://github.com/dingo/api/wiki/Creating-API-Endpoints
 */

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version(['v1'], [], function($api){

    /*
     * API v1
     */
    $api->group([
        'prefix' => 'v1',
        'namespace' => 'App\Http\Controllers\Api\V1'
    ], function($api){
        // JWT Authentication
        //Route::resource('authenticate', 'AuthenticateController', ['only' => 'index']);
        $api->post('authenticate', 'AuthenticateController@authenticate');
    });


    // Protected Routes
    $api->group(['middleware' => 'auth'], function ($api) {
        $api->get('user/{id}', 'App\Http\Controllers\DashboardController@user');
        $api->get('currentUser', 'App\Http\Controllers\DashboardController@currentUser');

        $api->get('dashboard', 'App\Http\Controllers\DashboardController@index');

    });
});


// Route for frontend requests
/*Route::group([
    //'middleware' => ['auth'],
    'prefix' => '/api/'
], function() {

    // JWT Authentication
    Route::resource('authenticate', 'AuthenticateController', ['only' => 'index']);
    Route::post('authenticate', 'AuthenticateController@authenticate');

    Route::get('dashboard', 'DashboardController@index');

    Route::get('user/{id}', 'DashboardController@user');
    Route::get('currentUser', 'DashboardController@currentUser');

    // Upload file
    //Route::post('upload-file', 'UploadController@uploadFile');

});
*/

// Angular 2 templates route
Route::get('/templates/{template}', 'AngularTemplateController@index');

Route::get('/{action}', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);


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
