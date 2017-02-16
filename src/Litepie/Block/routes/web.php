<?php

// Admin  routes  for block
Route::group(['prefix' => trans_setlocale() . '/admin/block'], function () {
    Route::resource('block', 'BlockAdminController');
    Route::resource('category', 'CategoryAdminController');
});
