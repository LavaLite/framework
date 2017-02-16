<?php

// Admin routes  for contact
Route::group(['prefix' => 'admin/contact'], function () {
    Route::resource('contact', 'ContactAdminController');
});

// User routes for contact
Route::group(['prefix' => 'user/contact'], function () {
    Route::resource('contact', 'ContactUserController');
});

// Public routes for contact
Route::group(['prefix' => 'contacts'], function () {
    Route::get('/', 'ContactPublicController@index');
    Route::get('/{slug?}', 'ContactPublicController@show');
});

