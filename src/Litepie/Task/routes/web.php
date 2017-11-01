<?php

// Admin  routes  for task
Route::group(['prefix' => set_route_guard('web') .'/task'], function () {
	Route::get('task/status', 'TaskResourceController@taskList'); 
    Route::resource('task', 'TaskResourceController');
});

//  Public routes for task
Route::group(['prefix' => set_route_guard('web') .'/tasks'], function () {
    Route::get('/', 'TaskPublicController@index');
    Route::get('/{slug?}', 'TaskPublicController@show');
});



