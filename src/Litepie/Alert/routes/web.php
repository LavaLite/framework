<?php

// Admin  routes  for notification
Route::group(['prefix' => '/admin/alert'], function () {
    Route::get('notification/read/{notification}', 'NotificationAdminController@read');
    Route::put('news/workflow/{notification}/{step}', 'NotificationAdminController@putWorkflow');
    Route::resource('notification', 'NotificationAdminController');

});


// User  routes for notification
Route::group(['prefix' => '/user/alert'], function () {
    Route::resource('notification', 'NotificationUserController');
});


