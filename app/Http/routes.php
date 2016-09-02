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

use Dingo\Api\Routing\Router;

/**
 * API Routes
 * https://github.com/dingo/api/wiki/Creating-API-Endpoints
 */

/** @var \Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');

$api->version(['v1'], [
    'namespace' => 'App\Http\Controllers\Api'
], function(Router $api){

    // JWT Authentication
    $api->post('authenticate', 'ApiController@authenticate');
    $api->post('logout', 'ApiController@logout');
    $api->post('token', 'ApiController@getToken');

    // Protected Routes
    $api->group([
        'middleware' => 'jwt.auth'
    ], function (Router $api) {

        $api->get('/users', 'UserController@index');
        $api->get('/users/me', 'UserController@getCurrentUser');
        $api->get('/users/{id}', 'UserController@show');
        $api->post('/users/{id}', 'UserController@update');


    });
});

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
    Route::get('/', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);
});

/*
 * Every other route gets served by the AngularController
 */
Route::get('/{action?}', 'AngularRouteController@index');
