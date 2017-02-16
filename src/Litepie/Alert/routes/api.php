<?php

// Admin routes  for notification
Route::group(['prefix' => 'admin/alert'], function () {
    Route::resource('notification', 'NotificationAdminController');
});

// User routes for notification
Route::group(['prefix' => 'user/alert'], function () {
    Route::resource('notification', 'NotificationUserController');
});

// Public routes for notification
Route::group(['prefix' => 'alerts'], function () {
    Route::get('/', 'NotificationPublicController@index');
    Route::get('/{slug?}', 'NotificationPublicController@show');
});

