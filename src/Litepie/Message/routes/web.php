<?php

// Admin web routes  for message
Route::group(['prefix' => 'admin/message'], function () {
    Route::get('/message/sub/{slug}/{id}', 'MessageAdminController@updateSubStatus');
    Route::get('/message/status/{slug}', 'MessageAdminController@updateStatus');
    // Route::get('/message/Inbox', 'MessageAdminController@inbox');
    // Route::get('/compose', 'MessageAdminController@compose');
    Route::get('/search/{slug?}/{status?}', 'MessageAdminController@search');
    Route::get('/status/{status?}', 'MessageAdminController@showMessage');
    Route::get('/details/{caption}/{slug}', 'MessageAdminController@getDetails');
    Route::get('/reply/{id}', 'MessageAdminController@reply');
    Route::get('/forward/{id}', 'MessageAdminController@forward');
    Route::resource('/message', 'MessageAdminController');
    Route::get('/important/substatus', 'MessageAdminController@changeSubStatus');
    Route::get('/starred', 'MessageAdminController@starredMessages');
    Route::get('/important_msg', 'MessageAdminController@importantMessages');
    Route::get('/read-status', 'MessageAdminController@readUnreadStatus');
    Route::get('/compose', 'MessageAdminController@compose');
});


// User web routes for message
Route::group(['prefix' => 'user/message'], function () {

    Route::get('/message/sub/{slug}/{id}', 'MessageUserController@updateSubStatus');
    Route::get('/message/status/{slug}', 'MessageUserController@updateStatus');
    Route::get('/search/{slug?}/{status?}', 'MessageUserController@search');
    Route::get('/status/{status?}', 'MessageUserController@showMessage');
    Route::get('/details/{caption}/{slug}', 'MessageUserController@getDetails');
    Route::get('/reply/{id}', 'MessageUserController@reply');
    Route::get('/forward/{id}', 'MessageUserController@forward');
    Route::get('/important/substatus', 'MessageUserController@importantSubStatus');
    Route::get('/starred/substatus', 'MessageUserController@starredSubStatus');
    Route::get('/starred', 'MessageUserController@starredMessages');
    Route::get('/important', 'MessageUserController@importantMessages');
    Route::get('/compose', 'MessageUserController@compose');
    Route::post('/delete', 'MessageUserController@deleteMultiple');
    Route::resource('/message', 'MessageUserController');
});

// Client web routes for message
Route::group(['prefix' => 'client/message'], function () {

    Route::get('/message/sub/{slug}/{id}', 'MessageClientController@updateSubStatus');
    Route::get('/message/status/{slug}', 'MessageClientController@updateStatus');
    Route::get('/search/{slug?}/{status?}', 'MessageClientController@search');
    Route::get('/status/{status?}', 'MessageClientController@showMessage');
    Route::get('/details/{caption}/{slug}', 'MessageClientController@getDetails');
    Route::get('/reply/{id}', 'MessageClientController@reply');
    Route::get('/forward/{id}', 'MessageClientController@forward');
    Route::get('/important/substatus', 'MessageClientController@importantSubStatus');
    Route::get('/starred/substatus', 'MessageClientController@starredSubStatus');
    Route::get('/starred', 'MessageClientController@starredMessages');
    Route::get('/important', 'MessageClientController@importantMessages');
    Route::get('/compose', 'MessageClientController@compose');
    Route::post('/delete', 'MessageClientController@deleteMultiple');
    Route::resource('/message', 'MessageClientController');
});

// Public web routes for message
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', 'MessageController@index');
    Route::get('/{slug?}', 'MessageController@show');
});