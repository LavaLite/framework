<?php

// Admin API routes  for task
Route::group(['prefix' => trans_setlocale().'api/v1/admin/task'], function () {
    Route::resource('task', 'TaskAdminApiController');
});



// User API routes for task
Route::group(['prefix' => trans_setlocale().'api/v1/user/task'], function () {
    Route::resource('task', 'TaskUserApiController');
});



//  API routes for task
Route::group(['prefix' => trans_setlocale().'api/v1/tasks'], function () {
    Route::get('/', 'TaskApiController@index');
    Route::get('/{slug?}', 'TaskApiController@show');
});

