<?php

Route::group(['middleware' => 'auth.api', 'prefix' => 'api'] , function() {
    Route::get('status', 'Api\ApiController@status');
});
