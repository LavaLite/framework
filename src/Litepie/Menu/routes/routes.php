<?php

// Routes for menu.

Route::group(
    [
        'prefix' => '{guard}/menu',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::post('menu/{id}/tree', 'MenuResourceController@tree');
        Route::get('menu/{id}/test', 'MenuResourceController@test');
        Route::get('menu/{id}/nested', 'MenuResourceController@nested');

        Route::resource('menu', 'MenuResourceController');
        Route::resource('submenu', 'MenuSubResourceController');
    }
);
