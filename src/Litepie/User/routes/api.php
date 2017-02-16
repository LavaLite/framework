<?php

// Admin routes  for user
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('user', 'Api\UserAdminApiController');
});

// Admin routes  for permission
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('permission', 'Api\PermissionAdminApiController');
});

// Admin routes  for role
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('role', 'Api\RoleAdminApiController');
});

// Admin routes  for team
Route::group(['prefix' => 'admin/user'], function () {
    Route::resource('team', 'Api\TeamAdminApiController');
});
