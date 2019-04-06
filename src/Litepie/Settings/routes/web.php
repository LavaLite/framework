<?php

// Admin  routes  for setting
Route::group(['prefix' => '{guard}/settings'], function () {
    Route::get('/', 'SettingResourceController@index');
    Route::get('/{slug}', 'SettingResourceController@show');
    Route::post('/', 'SettingResourceController@store');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
			Route::group(['prefix' => '{guard}/settings'], function () {
			    Route::get('/', 'SettingResourceController@index');
			    Route::get('/{slug}', 'SettingResourceController@show');
			    Route::post('/', 'SettingResourceController@store');
			});
        }
    );
}
