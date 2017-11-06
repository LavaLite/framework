<?php

// Admin  routes  for revision
Route::group(['prefix' => set_route_guard('web').'/revision'], function () {
    Route::resource('revision', 'RevisionResourceController');
    Route::resource('activity', 'ActivityResourceController');
});

