<?php

// Admin  routes  for setting
Route::group(['prefix' => set_route_guard('web').'/settings'], function () {
    Route::resource('setting', 'SettingResourceController');
});


// User  routes for setting
Route::group(['prefix' => '/user/settings'], function () {
    Route::resource('setting', 'SettingUserController');
});




