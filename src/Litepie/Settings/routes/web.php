<?php

// Admin  routes  for setting
Route::group(['prefix' => set_route_guard('web').'/settings'], function () {
    Route::get('setting', 'SettingResourceController@index');
    Route::post('setting', 'SettingResourceController@saveSettings');
});
