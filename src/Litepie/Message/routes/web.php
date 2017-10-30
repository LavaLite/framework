<?php

// Admin web routes  for message
Route::group(['prefix' => set_route_guard('web') . '/message'], function () {
    Route::get('reply/{id}', 'MessageResourceController@reply');
    Route::get('forward/{id}', 'MessageResourceController@forward');
    Route::get('starred', 'MessageResourceController@starred');
    Route::get('important', 'MessageResourceController@important');
    Route::get('tags/add', 'MessageResourceController@tagAdd');
    Route::get('tags/remove', 'MessageResourceController@tagRemove');
    Route::get('tags/{slug}', 'MessageResourceController@withTags');
    Route::resource('message', 'MessageResourceController');
});