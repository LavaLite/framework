<?php

// API routes  for master
Route::prefix('{guard}/master')->group(function () {
	Route::get('master/form/{element}', 'MasterAPIController@form');
	Route::resource('master', 'MasterAPIController');
	Route::get('master/{type}/{key}/{value}', 'MasterAPIController@search');
});

if (Trans::isMultilingual()) {
	Route::group(
		[
			'prefix' => '{trans}',
			'where' => ['trans' => Trans::keys('|')],
		],
		function () {
			// Guard routes for masters
			Route::prefix('{guard}/master')->group(function () {
				Route::get('master/form/{element}', 'MasterAPIController@form');
				Route::apiResource('master', 'MasterAPIController');
			});
			// Public routes for masters
			Route::get('master/Master', 'MasterPublicController@getMaster');
		}
	);
}
