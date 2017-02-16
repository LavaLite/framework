<?php

// Admin  routes  for user
Route::group(['prefix' => '/admin/user'], function () {
    Route::post('user/change/team', 'UserAdminController@changeTeam');
    Route::resource('user', 'UserAdminController');
});

// Admin  routes  for permission
Route::group(['prefix' => '/admin/user'], function () {
    Route::resource('permission', 'PermissionAdminController');
});

// Admin  routes  for role
Route::group(['prefix' => '/admin/user'], function () {
    Route::resource('role', 'RoleAdminController');
});

// Admin  routes  for team
Route::group(['prefix' => '/admin/user'], function () {
    Route::post('team/add/member/{team}', 'TeamAdminController@addMember');
    Route::post('team/remove/member/{team}', 'TeamAdminController@removeMember');
    Route::resource('team', 'TeamAdminController');
});
