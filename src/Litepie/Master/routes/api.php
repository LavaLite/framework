<?php

// API routes  for master
Route::prefix('{guard}/master')->group(function () {
    Route::get('master/form/{element}', 'MasterResourceController@form');
    Route::resource('master', 'MasterResourceController');
    Route::get('master/{type}/{key}/{value}', 'MasterResourceController@search');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            // Guard routes for masters
            Route::prefix('{guard}/master')->group(function () {
                Route::get('master/form/{element}', 'MasterResourceController@form');
                Route::apiResource('master', 'MasterResourceController');
            });
            // Public routes for masters
        }
    );
}
