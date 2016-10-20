<?php

Route::group(['middleware' => 'web', 'prefix' => 'helpdesk', 'namespace' => 'Modules\Helpdesk\Http\Controllers'], function()
{
    Route::get('/', 'HelpdeskController@index');
});
