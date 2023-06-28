<?php

// Routes for notification.

// Guard routes for notification
Route::prefix('{guard}/notification')->group(function () {
    Route::resource('notification', 'NotificationResourceController');
});