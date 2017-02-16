<?php

// Admin  routes  for revision
Route::group(['prefix' => '/admin/revision'], function () {
    Route::resource('revision', 'RevisionAdminController');
    Route::resource('activity', 'ActivityAdminController');
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
