<?php

Route::group([
    'namespace' => '\\App\\Http\\Controllers',
    'prefix'    => trans_setlocale(),
], function () {
    Route::get('/home', 'UserController@home');

    Route::get('/client', 'ClientController@home');
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@home');
        Route::get('profile', 'AdminController@profile');
        Route::get('locked', 'AdminController@locked');
        Route::get('masters', 'AdminController@masters');
        Route::get('reports', 'AdminController@reports');
        Route::get('profile', 'AdminController@getProfile');
        Route::get('password', 'AdminController@getPassword');

        Route::post('profile', 'AdminController@postProfile');
        Route::post('password', 'AdminController@postPassword');
    });

    Route::group(['prefix' => '{guard?}'], function () {

        Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
        Route::get('login/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
        Route::get('verify/send', 'Auth\ResetPasswordController@sendVerification');
        Route::get('verify/{code?}', 'Auth\ResetPasswordController@verify');
    });

    Route::group(['prefix' => 'web'], function () {
        Route::get('password', 'UserController@getPassword');
        Route::post('password', 'UserController@postPassword');

        Route::get('profile', 'UserController@getProfile');
        Route::post('profile', 'UserController@postProfile');
        Route::get('api', 'UserController@apiList');

    });

    Route::group(['prefix' => 'client.web'], function () {
        Route::get('password', 'ClientController@getPassword');
        Route::post('password', 'ClientController@postPassword');
        Route::get('profile', 'ClientController@getProfile');
        Route::post('profile', 'ClientController@postProfile');
        Route::get('api', 'ClientController@apiList');
    });
    Route::get('logout', 'Auth\LoginController@logout');
    Route::get('locked', 'UserController@locked');

});
