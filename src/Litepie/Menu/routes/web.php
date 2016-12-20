<?php

Route::group(
    [
        'prefix' => trans_setlocale() . '/admin/menu',
    ], function () {
        Route::post('menu/{id}/tree', 'MenuAdminController@tree');
        Route::get('menu/{id}/test', 'MenuAdminController@test');
        Route::get('menu/{id}/nested', 'MenuAdminController@nested');

        Route::resource('menu', 'MenuAdminController');
        Route::resource('submenu', 'SubMenuAdminController');
    });
