<?php

// Admin routes  for workflow
Route::group(['prefix' => set_route_guard('web') . '/workflow'], function () {
    Route::resource('workflow', 'WorkflowResourceController');
});

