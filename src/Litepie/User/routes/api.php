<?php

// API routes  for team
Route::prefix('{guard}/teams')->group(function () {
    Route::resource('team', 'TeamAPIController');
});


if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            // Guard routes for pages
            Route::prefix('{guard}/teams')->group(function () {
                Route::apiResource('team', 'TeamAPIController');
            });
        }
    );
}


// API routes  for user
Route::prefix('{guard}/teams')->group(function () {
    Route::resource('user', 'UserAPIController');
});


if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            // Guard routes for pages
            Route::prefix('{guard}/teams')->group(function () {
                Route::apiResource('user', 'UserAPIController');
            });
        }
    );
}

