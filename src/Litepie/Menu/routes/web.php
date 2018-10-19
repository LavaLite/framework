<?php

// Admin  routes  for menu.
Route::group(
    [
        'prefix' => trans_setlocale().'/admin/menu',
    ], function () {
        Route::post('menu/{id}/tree', 'MenuResourceController@tree');
        Route::get('menu/{id}/test', 'MenuResourceController@test');
        Route::get('menu/{id}/nested', 'MenuResourceController@nested');

        Route::resource('menu', 'MenuResourceController');
        Route::resource('submenu', 'SubMenuResourceController');
    });
