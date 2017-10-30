<?php

// Admin  routes  for workflow
Route::group(['prefix' => set_route_guard('web').'/workflow'], function () {
    Route::get('workflow/news', 'WorkflowResourceController@getWorkflow');
    Route::resource('workflow', 'WorkflowResourceController');
});


// User  routes for workflow
Route::group(['prefix' => '/user/workflow'], function () {
    Route::resource('workflow', 'WorkflowUserController');
});

// Public  routes for workflow
Route::group(['prefix' => '/workflows'], function () {
    Route::get('workflow/{workflow}', 'WorkflowPublicController@getWorkflow');
    Route::post('workflow/{workflow}', 'WorkflowPublicController@postWorkflow');

});


