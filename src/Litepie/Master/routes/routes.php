<?php

Route::group(
    [
        'prefix' => '{guard}/master',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::get('/', 'MasterResourceController@index');
        Route::resource('master', 'MasterResourceController');
        Route::group(['prefix' => 'list/{type}'], function () {
            Route::get('/', 'MasterResourceController@index');
            Route::resource('master', 'MasterResourceController');
        });
    }
);
