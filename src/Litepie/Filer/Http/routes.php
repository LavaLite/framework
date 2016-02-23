<?php

Route::group(['middleware' => ['web']], function () {
    // File upload routes
    Route::post('upload/{table}/{folder}/{field}/{file}', 'UploadController@upload');

    //File/image display routes
    Route::get('image/{size}/{table}/{folder}/{field}/{file}', 'FileController@image');
    Route::get('file/{table}/{folder}/{field}/{file}', 'FileController@file');
    Route::get('file/download/{table}/{folder}/{field}/{file}', 'FileController@download');
});
