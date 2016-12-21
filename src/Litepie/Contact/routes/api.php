<?php

// Admin routes  for contact
Route::group(['prefix' => 'api/admin/contact'], function () {
    Route::resource('contact', 'Api\ContactAdminApiController');
});

// User routes for contact
Route::group(['prefix' => 'api/user/contact'], function () {
    Route::resource('contact', 'Api\ContactUserApiController');
});

// Public routes for contact
Route::group(['prefix' => 'api/contacts'], function () {
    Route::get('/', 'Api\ContactPublicApiController@index');
    Route::get('/{slug?}', 'Api\ContactPublicApiController@show');
});

