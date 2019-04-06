<?php

// Admin  routes  for user
Route::group([
    'prefix' => '{guard}/user',
], function () {
    Route::resource('user', 'UserResourceController');
    Route::resource('{type}', 'ClientResourceController', ['parameters' => [
        '{type}' => 'client',
    ]]);

});

Route::get('profile/{user}', 'UserPublicController@profile');

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            Route::group(['prefix' => '{guard}/user'], function () {
                Route::resource('user', 'UserResourceController');
                Route::resource('{type}', 'ClientResourceController', ['parameters' => [
                    '{type}' => 'client',
                ]]);
            });
            Route::get('profile/{user}', 'UserPublicController@profile');
        }
    );
}
