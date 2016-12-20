<?php

// Admin  routes  for user
Route::group(['prefix' => '/admin/user'], function () {
    Route::put('news/workflow/{user}/{step}', 'UserAdminController@putWorkflow');
    Route::resource('user', 'UserAdminController');
});


// User  routes for user
Route::group(['prefix' => '/user/user'], function () {
    Route::resource('user', 'UserUserController');
});

// Public  routes for user
Route::group(['prefix' => '/users'], function () {
    Route::get('news/workflow/{user}/{step}/{userid}', 'UserController@getWorkflow');
    Route::get('/', 'UserPublicController@index');
    Route::get('/{slug?}', 'UserPublicController@show');
});



// Admin  routes  for permission
Route::group(['prefix' => '/admin/user'], function () {
    Route::put('news/workflow/{permission}/{step}', 'PermissionAdminController@putWorkflow');
    Route::resource('permission', 'PermissionAdminController');
});


// User  routes for permission
Route::group(['prefix' => '/user/user'], function () {
    Route::resource('permission', 'PermissionUserController');
});

// Public  routes for permission
Route::group(['prefix' => '/users'], function () {
    Route::get('news/workflow/{permission}/{step}/{user}', 'PermissionController@getWorkflow');
    Route::get('/', 'PermissionPublicController@index');
    Route::get('/{slug?}', 'PermissionPublicController@show');
});



// Admin  routes  for role
Route::group(['prefix' => '/admin/user'], function () {
    Route::put('news/workflow/{role}/{step}', 'RoleAdminController@putWorkflow');
    Route::resource('role', 'RoleAdminController');
});


// User  routes for role
Route::group(['prefix' => '/user/user'], function () {
    Route::resource('role', 'RoleUserController');
});

// Public  routes for role
Route::group(['prefix' => '/users'], function () {
    Route::get('news/workflow/{role}/{step}/{user}', 'RoleController@getWorkflow');
    Route::get('/', 'RolePublicController@index');
    Route::get('/{slug?}', 'RolePublicController@show');
});



// Admin  routes  for team
Route::group(['prefix' => '/admin/user'], function () {
    Route::put('news/workflow/{team}/{step}', 'TeamAdminController@putWorkflow');
    Route::resource('team', 'TeamAdminController');
});


// User  routes for team
Route::group(['prefix' => '/user/user'], function () {
    Route::resource('team', 'TeamUserController');
});

// Public  routes for team
Route::group(['prefix' => '/users'], function () {
    Route::get('news/workflow/{team}/{step}/{user}', 'TeamController@getWorkflow');
    Route::get('/', 'TeamPublicController@index');
    Route::get('/{slug?}', 'TeamPublicController@show');
});

