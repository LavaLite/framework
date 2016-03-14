<?php

// Admin routes for module
Route::group(['prefix' => trans_setlocale().'/admin/user', 'middleware' => ['web', 'auth.role:admin']], function () {
    Route::resource('user', 'UserAdminController');
    Route::resource('role', 'RoleAdminController');
    Route::resource('permission', 'PermissionAdminController');
    Route::post('update-profile', 'UserAdminController@updateProfile');
    Route::post('change-password', 'UserAdminController@changePassword');
});

// User routes for module
Route::group(['prefix' => trans_setlocale().'/user', 'middleware' => ['web', 'auth']], function () {
    Route::get('profile', 'UserUserController@getProfile');
    Route::post('profile', 'UserUserController@postProfile');
    Route::get('password', 'UserUserController@getPassword');
    Route::post('password', 'UserUserController@postPassword');
});