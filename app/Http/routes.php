<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return Redirect::to('main');
});

Route::model( 'user' , 'App\User' );

Route::group( [
    'middleware' => 'auth' ,
        ] , function() {

        get( '/profile' , [
            'as' => 'profile' ,
            'uses' => 'ProfileController@index'
        ] );
        post( '/profile' , [
            'as' => 'profile.update' ,
            'uses' => 'ProfileController@update'
        ] );
        get( '/main' , [
            'as' => 'main' ,
            'uses' => 'MainController@index'
        ] );
        post( '/main' , [
            'as' => 'main.order' ,
            'uses' => 'MainController@order'
        ] );
        post( '/main{id}' , [
            'as' => 'main.changeUser' ,
            'uses' => 'MainController@changeUser'
        ] );
        get( '/main/finishOrder' , [
            'as' => 'main.finishOrder' ,
            'uses' => 'MainController@finishOrder'
        ] );
        get( '/main/{id}' , [
            'as' => 'main.vote' ,
            'uses' => 'MainController@vote'
        ] );
    } );

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

get( '/register' , [
    'as' => 'register' ,
    'uses' => 'Auth\AuthController@getRegister'
] );

post( '/register' , [
    'as' => 'post.register' ,
    'uses' => 'Auth\AuthController@postRegister'
] );

get( '/login' , [
    'as' => 'login' ,
    'uses' => 'Auth\AuthController@getLogin'
] );

post( '/login' , [
    'as' => 'post.login' ,
    'uses' => 'Auth\AuthController@postLogin'
] );

get( '/logout' , [
    'as' => 'logout' ,
    'uses' => 'Auth\AuthController@getLogout'
] );
