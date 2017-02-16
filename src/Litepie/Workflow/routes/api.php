<?php

// Admin routes  for workflow
Route::group(['prefix' => 'admin/workflow'], function () {
    Route::resource('workflow', 'WorkflowAdminController');
});

