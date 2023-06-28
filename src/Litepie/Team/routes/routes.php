<?php

// Routes for team.

Route::group(
    [
        'prefix' => '{guard}/team',
        'as' => 'guard.',
        'where' => ['guard' => implode('|', array_keys(config('auth.guards')))],
    ],
    function () {
        Route::post('team/attach/{team}', 'TeamResourceController@attach');
        Route::post('team/detach/{team}', 'TeamResourceController@detach');
        Route::resource('team', TeamResourceController::class);
    }
);
