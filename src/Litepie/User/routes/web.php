<?php




Route::group([
    'namespace' => '\\App\\Http\\Controllers',
    'prefix'    => trans_setlocale() . '/' . set_route_guard('web'),
], function () {
    Route::get('locked', 'ResourceController@locked');
    Route::get('masters', 'ResourceController@masters');
    Route::get('reports', 'ResourceController@reports');

    Route::get('profile', 'ResourceController@getProfile');
    Route::get('password', 'ResourceController@getPassword');
    Route::post('profile', 'ResourceController@postProfile');
    Route::post('password', 'ResourceController@postPassword');

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
