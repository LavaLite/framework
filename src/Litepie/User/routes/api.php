<?php

// Admin routes  for user
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('user', 'Api\UserAdminApiController');
});

// User routes for user
Route::group(['prefix' => 'user/user'], function () {
    Route::resource('user', 'Api\UserUserApiController');
});

// Public routes for user
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\UserPublicApiController@index');
    Route::get('/{slug?}', 'Api\UserPublicApiController@show');
});


// Admin routes  for permission
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('permission', 'Api\PermissionAdminApiController');
});

// User routes for permission
Route::group(['prefix' => 'user/user'], function () {
    Route::resource('permission', 'Api\PermissionUserApiController');
});

// Public routes for permission
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\PermissionPublicApiController@index');
    Route::get('/{slug?}', 'Api\PermissionPublicApiController@show');
});


// Admin routes  for role
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('role', 'Api\RoleAdminApiController');
});

// User routes for role
Route::group(['prefix' => 'user/user'], function () {
    Route::resource('role', 'Api\RoleUserApiController');
});

// Public routes for role
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\RolePublicApiController@index');
    Route::get('/{slug?}', 'Api\RolePublicApiController@show');
});


// Admin routes  for team
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('team', 'Api\TeamAdminApiController');
});

// User routes for team
Route::group(['prefix' => 'user/user'], function () {
    Route::resource('team', 'Api\TeamUserApiController');
});

// Public routes for team
Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'Api\TeamPublicApiController@index');
    Route::get('/{slug?}', 'Api\TeamPublicApiController@show');
});

