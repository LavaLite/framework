<?php

// Admin routes  for block
Route::group(['prefix' => trans_setlocale().'api/v1/admin/blocks'], function () {
    Route::resource('block', 'Litepie\Blocks\Http\Controllers\BlockAdminApiController');
});

// User routes for block
Route::group(['prefix' => trans_setlocale().'api/v1/user/blocks'], function () {
    Route::resource('block', 'Litepie\Blocks\Http\Controllers\BlockUserApiController');
});

// Public routes for block
Route::group(['prefix' => trans_setlocale().'api/v1/blocks'], function () {
    Route::get('/', 'Litepie\Blocks\Http\Controllers\BlockPublicApiController@index');
    Route::get('/{slug?}', 'Litepie\Blocks\Http\Controllers\BlockPublicApiController@show');
});

