<?php

Route::group(['prefix' =>  Trans::setLocale().'/admin/menu'], function () {
    Route::post('menu/{id}/tree', 'Litepie\Menu\Http\Controllers\MenuAdminController@tree');
    Route::get('menu/{id}/test', 'Litepie\Menu\Http\Controllers\MenuAdminController@test');
    Route::get('menu/{id}/nested', 'Litepie\Menu\Http\Controllers\MenuAdminController@nested');

    Route::resource('menu', 'Litepie\Menu\Http\Controllers\MenuAdminController');
    Route::resource('submenu', 'Litepie\Menu\Http\Controllers\SubMenuAdminController');
});
