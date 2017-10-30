<?php

// Admin routes  for revision
Route::group(['prefix' => set_route_guard('web') . '/revision'], function () {
    Route::resource('revision', 'RevisionResourceController');
    Route::resource('activity', 'ActivityResourceController');
});

// User routes for revision
Route::group(['prefix' => 'user/revision'], function () {
    Route::resource('revision', 'RevisionUserController');
    Route::resource('activity', 'ActivityUserController');
});


