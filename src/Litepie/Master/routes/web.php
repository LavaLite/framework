<?php

// Resource routes for master
Route::group(['prefix' => '{guard}/masters'], function () {
    Route::get('/', 'MasterResourceController@index');
    Route::group(['prefix' => '{group}/{type}'], function () {
        Route::get('/', 'MasterResourceController@index');
        Route::resource('master', 'MasterResourceController');
    });
});

// Route::get('masters/{type?}', 'MasterPublicController@options');
if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
        ],
        function () {
            Route::group(['prefix' => '{guard}/masters'], function () {
                Route::get('/', 'MasterResourceController@index');
                Route::group(['prefix' => '{group}/{type}'], function () {
                    Route::get('/', 'MasterResourceController@index');
                    Route::resource('master', 'MasterResourceController');
                });
            });
        }
    );
}
