<?php

// Admin routes for module
Route::group(['prefix' => trans_setlocale() . '/admin/page'], function () {
    Route::resource('page', 'PageAdminController');
});

// User routes for module
Route::group(['prefix' => trans_setlocale() . '/user/page'], function () {
    Route::resource('page', 'PageUserController');
});

// Public routes for module
Route::group(['prefix' => trans_setlocale()], function () {
    Route::get('/{slug}.html', 'PagePublicController@getPage');
});
