<?php

// Admin  routes  for revision
Route::group(['prefix' => set_route_guard('web').'/revision'], function () {
    Route::resource('revision', 'RevisionResourceController');
    Route::resource('activity', 'ActivityResourceController');
});

// User  routes for revision
Route::group(['prefix' => '/user/revision'], function () {
    Route::resource('revision', 'RevisionUserController');
    Route::resource('activity', 'ActivityUserController');
});
// User  routes for revision
Route::group(['prefix' => '/client/revision'], function () {
    Route::resource('revision', 'RevisionClientController');
    Route::resource('activity', 'ActivityClientController');
});
