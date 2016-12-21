<?php

// Admin  routes  for news
Route::group(['prefix' => '/admin/news'], function () {
    Route::put('news/workflow/{news}/{step}', 'NewsAdminController@putWorkflow');
    Route::resource('news', 'NewsAdminController');
});


// User  routes for news
Route::group(['prefix' => '/user/news'], function () {
    Route::resource('news', 'NewsUserController');
});
// Client  routes for news
Route::group(['prefix' => '/client/news'], function () {
    Route::resource('news', 'NewsClientController');
});

// Public  routes for news
Route::group(['prefix' => '/news'], function () {
    Route::get('news/workflow/{news}/{step}/{user}', 'NewsPublicController@getWorkflow');
    Route::get('/', 'NewsPublicController@index');
    Route::get('/{slug?}', 'NewsPublicController@show');
});