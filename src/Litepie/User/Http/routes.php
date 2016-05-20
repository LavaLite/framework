<?php

// Admin routes for module
Route::group([
    'namespace' => 'Litepie\User\Http\Controllers',
    'prefix'    => trans_setlocale() . '/admin/user',
], function () {
    Route::resource('user', 'UserAdminWebController');
    Route::resource('role', 'RoleAdminWebController');
    Route::resource('permission', 'PermissionAdminWebController');
});

Route::group([
    'namespace' => 'App\\Http\\Controllers',
    'prefix'    => trans_setlocale(),
], function () {

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', 'AdminWebController@home');
        Route::get('profile', 'AdminWebController@profile');
        Route::get('locked', 'AdminWebController@locked');
        Route::get('masters', 'AdminWebController@masters');
        Route::get('reports', 'AdminWebController@reports');
        Route::get('profile', 'AdminWebController@getProfile');
        Route::get('password', 'AdminWebController@getPassword');

        Route::post('profile', 'AdminWebController@postProfile');
        Route::post('password', 'AdminWebController@postPassword');
    });

    Route::get('profile', 'UserWebController@getProfile');
    Route::get('password', 'UserWebController@getPassword');
    Route::get('locked', 'UserWebController@locked');

    Route::post('profile', 'UserWebController@postProfile');
    Route::post('password', 'UserWebController@postPassword');

    Route::get('api/v1/login', 'Auth\AuthController@apiLogin');
    Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('verify/send', 'Auth\AuthController@sendVerification');
    Route::get('verify/{code?}', 'Auth\AuthController@verify');
    Route::get('locked', 'Auth\AuthController@locked');

});
