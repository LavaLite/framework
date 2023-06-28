<?php

// Routes for log.

// Guard routes for activity
Route::prefix('{guard}/log')->group(function () {
    Route::resource('action', 'ActionResourceController');
    Route::resource('activity', 'ActivityResourceController');
});