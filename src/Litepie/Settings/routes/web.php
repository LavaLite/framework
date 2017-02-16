<?php

// Admin  routes  for setting
Route::group(['prefix' => '/admin/settings'], function () {
    Route::put('news/workflow/{setting}/{step}', 'SettingAdminController@putWorkflow');
    Route::resource('setting', 'SettingAdminController');
});


// User  routes for setting
Route::group(['prefix' => '/user/settings'], function () {
    Route::resource('setting', 'SettingUserController');
});

// Public  routes for setting
Route::group(['prefix' => '/settings'], function () {
    Route::get('news/workflow/{setting}/{step}/{user}', 'SettingPublicController@getWorkflow');
    Route::get('/', 'SettingPublicController@index');
    Route::get('/{slug?}', 'SettingPublicController@show');
});


