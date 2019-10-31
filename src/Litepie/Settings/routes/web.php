<?php

// Admin  routes  for setting
Route::group(['prefix' => '{guard}/settings'], function () {
    Route::get('/', 'SettingResourceController@index');
    Route::get('/{slug}', 'SettingResourceController@show');
    Route::post('/{type}', 'SettingResourceController@store');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}'
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
