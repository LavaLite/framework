<?php

// Admin  routes  for notification
Route::group(['prefix' => set_route_guard('web').'/alerts'], function () {
    Route::get('notification/read/{notification}', 'NotificationResourceController@read');
    Route::put('news/workflow/{notification}/{step}', 'NotificationResourceController@putWorkflow');
    Route::resource('notification', 'NotificationResourceController');
});
