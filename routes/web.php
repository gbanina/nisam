<?php

Route::get('/', function () {
    return Redirect::to('main');
});

Route::group(['middleware' => 'auth'] , function()
{
    Route::get('profile',          ['as' => 'profile',          'uses' => 'ProfileController@index']);
    Route::post('profile',         ['as' => 'profile.update' ,  'uses' => 'ProfileController@update']);
    Route::get('main' ,            ['as' => 'main',             'uses' => 'MainController@index']);
    Route::post('main' ,           ['as' => 'main.order',       'uses' => 'MainController@order']);
    Route::post('main/{id}',       ['as' => 'main.changeUser',  'uses' => 'MainController@changeUser']);
    Route::get('main/finishOrder', ['as' => 'main.finishOrder', 'uses' => 'MainController@finishOrder']);
    Route::get('main/{id}',        ['as' => 'main.vote',        'uses' => 'MainController@vote']);
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
