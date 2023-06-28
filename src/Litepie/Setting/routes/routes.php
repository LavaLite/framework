<?php

Route::group(
    [
        'prefix' => '{guard}/setting',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::get('/setting', 'SettingResourceController@index');
        Route::get('/setting/{type}', 'SettingResourceController@show');
        Route::post('/setting/{type}', 'SettingResourceController@store');

    }
);
