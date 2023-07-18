<?php

// Routes for user.

Route::group(
    [
        'prefix' => '{guard}/user',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::get('settings', 'UserResourceController@masterDatas');
        Route::get('users/{status?}', 'UserResourceController@index');
        Route::resource('user', 'UserResourceController');
        Route::resource('client', 'ClientResourceController');
    }
);
