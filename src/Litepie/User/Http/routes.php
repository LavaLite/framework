<?php

// Admin routes for user
Route::group(
[
'prefix' => Trans::setLocale().'/admin/user'
],
function () {
    Route::resource('user', 'UserAdminController');
    Route::resource('role', 'RoleAdminController');
    Route::resource('permission', 'PermissionAdminController');
    Route::post('update-profile', 'UserAdminController@updateProfile');
    Route::post('change-password', 'UserAdminController@changePassword');

});
