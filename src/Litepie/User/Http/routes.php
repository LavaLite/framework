<?php

// Admin routes for module
Route::group(['prefix' => trans_setlocale() . '/admin/user', 'middleware' => ['web', 'auth.role:admin']], function () {
    Route::resource('user', 'UserAdminController');
    Route::resource('role', 'RoleAdminController');
    Route::resource('permission', 'PermissionAdminController');
    Route::post('update-profile', 'UserAdminController@updateProfile');
    Route::post('change-password', 'UserAdminController@changePassword');
});

// User routes for module
Route::group(['prefix' => trans_setlocale() . '/user', 'middleware' => ['web', 'auth']], function () {
    Route::get('profile', 'UserUserController@getProfile');
    Route::post('profile', 'UserUserController@postProfile');
    Route::get('password', 'UserUserController@getPassword');
    Route::post('password', 'UserUserController@postPassword');
});

Route::group(['middleware' => 'web'], function () {

    Route::get('register/{role?}', '\App\Http\Controllers\Auth\AuthController@showRegistrationForm');
    Route::get('login/{provider}', '\App\Http\Controllers\Auth\AuthController@redirectToProvider');
    Route::get('login/{provider}/callback', '\App\Http\Controllers\Auth\AuthController@handleProviderCallback');
    Route::get('verify/send', '\App\Http\Controllers\Auth\AuthController@sendVerification');
    Route::get('verify/{code?}', '\App\Http\Controllers\Auth\AuthController@verify');
    Route::get('locked', '\App\Http\Controllers\Auth\AuthController@locked');

    Route::get(trans_setlocale() . 'admin', '\App\Http\Controllers\AdminController@home');
    Route::get(trans_setlocale() . 'admin/profile', '\App\Http\Controllers\AdminController@profile');
    Route::get(trans_setlocale() . 'admin/locked', '\App\Http\Controllers\AdminController@locked');
    Route::get(trans_setlocale() . 'admin/masters', '\App\Http\Controllers\AdminController@masters');
    Route::get(trans_setlocale() . 'admin/reports', '\App\Http\Controllers\AdminController@reports');
});
