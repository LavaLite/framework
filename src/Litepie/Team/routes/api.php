<?php

// API routes  for user
Route::prefix('{guard}/teams')->group(function () {
    Route::get('teams/select', 'TeamResourceController@select');
    Route::apiResource('team', 'TeamResourceController');
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
                Route::apiResource('team', 'TeamResourceController');
            });
        }
    );
}
