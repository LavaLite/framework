<?php

Route::group(['prefix' => '{guard}/upload'], function () {
    // File upload routes
    Route::post('{config}/{path?}', 'FileController@upload')->where('path', '(.*)');
});

Route::get('image/{disk}/{template}/{path}', 'FileController@image')->where('path', '(.*)');
Route::get('filer/download/{disk}/{path?}', 'FileController@download')->where('path', '(.*)');
Route::get('filer/display/{disk}/{path?}', 'FileController@display')->where('path', '(.*)');
