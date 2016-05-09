<?php

// Admin routes for module
Route::group([
    'namespace' => 'Litepie\User\Http\Controllers',
    'prefix'    => trans_setlocale() . '/admin/user',
], function () {
    Route::resource('user', 'UserAdminController');
    Route::resource('role', 'RoleAdminController');
    Route::resource('permission', 'PermissionAdminController');
});

Route::group([
    'namespace' => 'App\\Http\\Controllers',
    'prefix'    => trans_setlocale(),
], function () {

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

    Route::get('profile', 'UserController@getProfile');
    Route::get('password', 'UserController@getPassword');
    Route::get('locked', 'UserController@locked');

    Route::post('profile', 'UserController@postProfile');
    Route::post('password', 'UserController@postPassword');

    Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('verify/send', 'Auth\AuthController@sendVerification');
    Route::get('verify/{code?}', 'Auth\AuthController@verify');
    Route::get('locked', 'Auth\AuthController@locked');

});
