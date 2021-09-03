<?php

// Admin  routes  for menu.
Route::prefix('{guard}/menu')->group(function () {
    Route::post('menu/{id}/tree', 'MenuResourceController@tree');
    // Route::get('menu/{id}/test', 'MenuResourceController@test');
    Route::get('menu/{id}/submenu', 'SubMenuResourceController@index');

    Route::resource('menu', 'MenuResourceController');
    Route::resource('submenu', 'SubMenuResourceController');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            Route::group(['prefix' => '{guard}/menu'], function () {
                Route::post('menu/{id}/tree', 'MenuResourceController@tree');
                Route::get('menu/{id}/test', 'MenuResourceController@test');
                Route::get('menu/{id}/nested', 'MenuResourceController@nested');

                Route::resource('menu', 'MenuResourceController');
                Route::resource('submenu', 'SubMenuResourceController');
            });
        }
    );
}
