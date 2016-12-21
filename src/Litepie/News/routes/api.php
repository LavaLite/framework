<?php

// Admin routes  for news
Route::group(['prefix' => 'admin/news'], function () {
    Route::resource('news', 'NewsAdminController');
});

// User routes for news
Route::group(['prefix' => 'user/news'], function () {
    Route::resource('news', 'NewsUserController');
});

// Public routes for news
Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsPublicController@index');
    Route::get('/{slug?}', 'NewsPublicController@show');
});
