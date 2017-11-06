<?php

// Admin  routes  for workflow
Route::group(['prefix' => set_route_guard('web').'/workflow'], function () {
    Route::get('workflow/news', 'WorkflowResourceController@getWorkflow');
    Route::resource('workflow', 'WorkflowResourceController');
});
