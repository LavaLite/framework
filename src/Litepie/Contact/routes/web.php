<?php

// Admin  routes  for contact
Route::group(['prefix' => '/admin/contact'], function () {
    Route::put('news/workflow/{contact}/{step}', 'ContactAdminController@putWorkflow');
    Route::resource('contact', 'ContactAdminController');
});


// User  routes for contact
Route::group(['prefix' => '/user/contact'], function () {
    Route::resource('contact', 'ContactUserController');
});

// Public  routes for contact
Route::group(['prefix' => '/contacts'], function () {
    //Route::get('news/workflow/{contact}/{step}/{user}', 'ContactController@getWorkflow');
    Route::get('/', 'ContactPublicController@index');
    Route::post('/sendmail', 'ContactPublicController@sendMail');
    Route::post('/requestInfo', 'ContactPublicController@requestInfo');
});


