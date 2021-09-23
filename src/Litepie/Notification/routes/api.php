<?php

// Admin routes  for notification
Route::group(['prefix' => set_route_guard('web').'/alerts'], function () {
    Route::resource('notification', 'NotificationResourceController');
});

// User routes for notification
Route::group(['prefix' => 'user/alerts'], function () {
    Route::resource('notification', 'NotificationUserController');
});

// Public routes for notification
Route::group(['prefix' => 'alerts'], function () {
    Route::get('/', 'NotificationPublicController@index');
    Route::get('/{slug?}', 'NotificationPublicController@show');
});
