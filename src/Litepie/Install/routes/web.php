<?php

Route::group(
    [
        'prefix' => trans_setlocale(),
    ], function () {
        Route::get('install', 'InstallController@index');
        Route::get('install/db', 'InstallController@getDb');
        Route::post('install/db', 'InstallController@postDb');
        Route::get('install/publish', 'InstallController@getPublish');
        Route::post('install/publish', 'InstallController@postPublish');
        Route::get('install/user', 'InstallController@getUser');
        Route::post('install/user', 'InstallController@postUser');
        Route::get('install/finished', 'InstallController@finished');
    });
