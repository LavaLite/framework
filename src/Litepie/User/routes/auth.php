<?php

/**
 * @Author: George John
 * @Date:   2018-01-19 18:11:12
 * @Last Modified by:   George John
 * @Last Modified time: 2018-01-19 18:12:19
 */
Route::group([
    'namespace' => '\\App\\Http\\Controllers',
    'prefix'    => trans_setlocale().'/'.set_route_guard('web'),
], function () {
    Route::get('home', 'UserController@home');
    Route::get('locked', 'UserController@locked');
    Route::get('masters', 'UserController@masters');
    Route::get('reports', 'UserController@reports');

    Route::get('profile', 'UserController@getProfile');
    Route::get('password', 'UserController@getPassword');
    Route::post('profile', 'UserController@postProfile');
    Route::post('password', 'UserController@postPassword');

    Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
    Route::get('verify/send', 'Auth\LoginController@sendVerification');
    Route::get('verify/{code?}', 'Auth\LoginController@verify');

    Route::get('logout', 'Auth\LoginController@logout');
});
