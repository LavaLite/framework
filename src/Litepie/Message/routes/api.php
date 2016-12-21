<?php
// Admin API routes  for message
Route::group(['prefix' => 'admin/message'], function () {
    Route::resource('message', 'MessageAdminApiController');
});

// User API routes for message
Route::group(['prefix' => 'user/message'], function () {
    Route::resource('message', 'MessageUserApiController');
});

// Public API routes for message
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', 'MessagePublicApiController@index');
    Route::get('/{slug?}', 'MessagePublicApiController@show');
});
