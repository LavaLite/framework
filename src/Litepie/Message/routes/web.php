<?php

// Admin web routes  for message
Route::group(['prefix' => set_route_guard('web') . '/message'], function () {
    Route::get('message/reply/{id}', 'MessageResourceController@reply');
    Route::get('message/forward/{id}', 'MessageResourceController@forward');
    Route::get('message/starred', 'MessageResourceController@getStarred');
    Route::get('message/label/add', 'MessageResourceController@labelAdd');
    Route::get('message/label/remove', 'MessageResourceController@labelRemove');
    Route::get('message/list/{folder?}/{label?}', 'MessageResourceController@list');
    Route::resource('message', 'MessageResourceController');
});