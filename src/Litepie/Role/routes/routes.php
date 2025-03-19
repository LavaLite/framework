<?php

// Routes for role.

Route::group(
    [
        'prefix' => '{guard}/role',
        'as'     => 'guard.',
        'where'  => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::resource('role', 'RoleResourceController');
        Route::resource('permission', 'PermissionResourceController');
    }
);
