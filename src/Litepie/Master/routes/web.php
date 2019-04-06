<?php

// Resource routes  for master
Route::group(['prefix' => '{guard}/masters'], function () {
    Route::get('{group}/{type}/{master}', 'MasterResourceController@show');
    Route::get('{group?}/{type?}', 'MasterResourceController@index');
});

// Route::get('masters/{type?}', 'MasterPublicController@options');
if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
			Route::group(['prefix' => '{guard}/masters'], function () {
			    Route::get('{group}/{type}/{master}', 'MasterResourceController@show');
			    Route::get('{group?}/{type?}', 'MasterResourceController@index');
			});
        }
    );
}
