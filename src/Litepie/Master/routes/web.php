<?php

// Resource routes for master
Route::group(['prefix' => '{guard}'], function () {
    Route::resource('masters', 'MasterResourceController');
});

// Route::get('masters/{type?}', 'MasterPublicController@options');
if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
        ],
        function () {
            Route::resource('masters', 'MasterResourceController');
        }
    );
}
