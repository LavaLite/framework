<?php

// Resource routes for master
Route::group(['prefix' => '{guard}/masters'], function () {
    Route::get('/', 'MasterResourceController@index');
    Route::group(['prefix' => '{type}'], function () {
        Route::resource('master', 'MasterResourceController');
    });
});
