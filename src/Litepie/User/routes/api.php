<?php

// API routes  for user
Route::prefix('{guard}/users')->group(function () {
    // Route::get('select', 'UserAPIController@select');
    Route::get('users/select', 'UserAPIController@select');
	Route::get('user/profile', 'UserAPIController@profile');
	Route::post('user/postprofile', 'UserAPIController@postProfile');
	Route::post('user/changepassword', 'UserAPIController@postChangePassword');
	Route::post('user/changeteam', 'UserAPIController@postChangeTeam');
	Route::get('teams/select', 'TeamAPIController@select');
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
