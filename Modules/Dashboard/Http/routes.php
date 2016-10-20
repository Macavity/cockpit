<?php

Route::group(['middleware' => 'web', 'prefix' => 'dashboard', 'namespace' => 'Modules\Dashboard\Http\Controllers'], function()
{
    Route::get('/', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);
});
