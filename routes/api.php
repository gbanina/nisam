<?php

Route::group(['middleware' => 'auth.api', 'prefix' => 'api'] , function() {
    Route::get('/', 'Api\ApiController@index');
    Route::get('status', 'Api\ApiController@status');
    Route::get('orders', 'Api\ApiController@orders');
});
