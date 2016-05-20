<?php

Route::group([
    'namespace' => 'Litepie\Menu\Http\Controllers',
    'prefix'    => trans_setlocale() . '/admin/menu'], function () {
    Route::post('menu/{id}/tree', 'MenuAdminWebController@tree');
    Route::get('menu/{id}/test', 'MenuAdminWebController@test');
    Route::get('menu/{id}/nested', 'MenuAdminWebController@nested');

    Route::resource('menu', 'MenuAdminWebController');
    Route::resource('submenu', 'SubMenuAdminWebController');
});
