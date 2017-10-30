<?php




Route::group([
    'namespace' => '\\App\\Http\\Controllers',
    'prefix'    => trans_setlocale() . '/' . set_route_guard('web'),
], function () {
    Route::get('locked', 'UserController@locked');
    Route::get('masters', 'UserController@masters');
    Route::get('reports', 'UserController@reports');

    Route::get('profile', 'UserController@getProfile');
    Route::get('password', 'UserController@getPassword');
    Route::post('profile', 'UserController@postProfile');
    Route::post('password', 'UserController@postPassword');

    Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider');
    Route::get('login/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');
    Route::get('verify/send', 'Auth\ResetPasswordController@sendVerification');
    Route::get('verify/{code?}', 'Auth\ResetPasswordController@verify');

    Route::get('logout', 'Auth\LoginController@logout');

});

// Admin  routes  for user
Route::group([
    'namespace' => 'Litepie\User\Http\Controllers',
    'prefix' => set_route_guard('web').'/user'
], function () {
    Route::post('user/change/team', 'UserResourceController@changeTeam');
    Route::post('team/add/member/{team}', 'TeamResourceController@addMember');
    Route::post('team/remove/member/{team}', 'TeamResourceController@removeMember');
    
    Route::resource('user', 'UserResourceController');
    Route::resource('team', 'TeamResourceController');
});
