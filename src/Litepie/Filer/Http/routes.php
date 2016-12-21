<?php

Route::group(['middleware' => ['web']], function () {
    // File upload routes
    Route::post('upload/{config}/{folder}/{field}/{file}', 'UploadController@upload');
    Route::post('crop/{config}/{folder}/{field}/{file}', 'UploadController@crop');

    //File/image display routes
    Route::get('image/{size}/{config}/{folder}/{field}/{file}', 'FileController@image');
    Route::get('file/{config}/{folder}/{field}/{file}', 'FileController@file');
});
