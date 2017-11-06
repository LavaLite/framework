<?php

// Admin  routes  for workflow
Route::group(['prefix' => set_route_guard('api').'/workflow'], function () {
    Route::get('workflow/news', 'WorkflowResourceController@getWorkflow');
    Route::resource('workflow', 'WorkflowResourceController');
});


