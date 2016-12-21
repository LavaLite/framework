<?php

// Admin  routes  for block
Route::group(['prefix' => trans_setlocale().'/admin/block'], function () {
    Route::resource('block', 'BlockAdminController');
    Route::resource('category', 'CategoryAdminController');
});


// User  routes for block
Route::group(['prefix' => trans_setlocale().'/user/block'], function () {
    Route::resource('block', 'BlockUserController');
});

// Public  routes for block
Route::group(['prefix' => trans_setlocale().'/block'], function () {
    Route::get('/', 'BlockPublicController@index');
    Route::get('/{slug?}', 'BlockPublicController@show');
});


