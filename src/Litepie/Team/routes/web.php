<?php

// Admin  routes  for team
Route::group([
    'prefix' => '{guard}/teams',
], function () {
    Route::post('team/attach', 'TeamResourceController@attach');
    Route::post('team/detach', 'TeamResourceController@detach');
    Route::resource('team', 'TeamResourceController');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            Route::group(['prefix' => '{guard}/teams'], function () {
                Route::resource('team', 'TeamResourceController');
            });
        }
    );
}
