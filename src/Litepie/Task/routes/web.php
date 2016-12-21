<?php

// Admin  routes  for task
Route::group(['prefix' => trans_setlocale().'/admin/task'], function () {
	Route::get('status', 'TaskAdminController@taskList'); 
    Route::resource('task', 'TaskAdminController');
});

// User  routes for task
Route::group(['prefix' => trans_setlocale().'/user/task'], function () {
	Route::get('status', 'TaskUserController@taskList'); 
    Route::resource('task', 'TaskUserController');
});


// User  routes for task
Route::group(['prefix' => trans_setlocale().'/client/task'], function () {
	Route::get('status', 'TaskClientController@taskList'); 
    Route::resource('task', 'TaskClientController');
});

//  Public routes for task
Route::group(['prefix' => trans_setlocale().'/tasks'], function () {
    Route::get('/', 'TaskController@index');
    Route::get('/{slug?}', 'TaskController@show');
});



