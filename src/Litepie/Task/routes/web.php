<?php

// Admin  routes  for task
Route::group(['prefix' => set_route_guard('web') .'/task'], function () {
	Route::get('task/status', 'TaskResourceController@taskList'); 
    Route::resource('task', 'TaskResourceController');
});




