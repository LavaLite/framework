<?php

// API routes  for user
Route::prefix('{guard}/users')->group(function () {
    Route::get('select', 'UserAPIController@select');
    Route::apiResource('user', 'UserAPIController');
    Route::apiResource('team', 'TeamAPIController');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where' => ['trans' => Trans::keys('|')],
        ],
        function () {
            // Guard routes for pages
            Route::prefix('{guard}/teams')->group(function () {
                Route::get('select', 'UserAPIController@select');
                Route::apiResource('user', 'UserAPIController');
                Route::apiResource('team', 'TeamAPIController');
            });
        }
    );
}
