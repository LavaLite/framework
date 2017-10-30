<?php

// Admin  routes  for roles
Route::group(['prefix' => set_route_guard('web').'/roles'], function () {
    Route::resource('permission', 'PermissionResourceController');
    Route::resource('role', 'RoleResourceController');
});
