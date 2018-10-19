<?php


// Admin  routes  for user
Route::group([
    'namespace' => 'Litepie\User\Http\Controllers',
    'prefix'    => set_route_guard('web').'/user',
], function () {
    Route::post('user/change/team', 'UserResourceController@changeTeam');
    // Route::post('team/add/member/{team}', 'TeamResourceController@addMember');
    // Route::post('team/remove/member/{team}', 'TeamResourceController@removeMember');

    Route::resource('user', 'UserResourceController');
    Route::resource('{type}', 'ClientResourceController', ['parameters' => [
        '{type}' => 'client',
    ]]);
    // Route::resource('team', 'TeamResourceController');
});
