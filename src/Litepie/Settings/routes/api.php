<?php

// Admin routes  for setting
Route::group(['prefix' => 'admin/settings'], function () {
    Route::resource('setting', 'SettingAdminController');
});

// User routes for setting
Route::group(['prefix' => 'user/settings'], function () {
    Route::resource('setting', 'SettingUserController');
});

// Public routes for setting
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'SettingPublicController@index');
    Route::get('/{slug?}', 'SettingPublicController@show');
});

