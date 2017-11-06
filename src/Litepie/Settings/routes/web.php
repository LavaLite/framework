<?php

// Admin  routes  for setting
Route::group(['prefix' => set_route_guard('web').'/settings'], function () {
    Route::resource('setting', 'SettingResourceController');
});






