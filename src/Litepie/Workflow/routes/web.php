<?php

// Admin  routes  for workflow
Route::group(['prefix' => '/admin/workflow'], function () {
    Route::get('workflow/news', 'WorkflowAdminController@getWorkflow');
    Route::resource('workflow', 'WorkflowAdminController');
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


