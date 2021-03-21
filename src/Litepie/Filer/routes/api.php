<?php

Route::group(['prefix' => 'api/{guard}/upload'], function () {
    // File upload routes
    Route::post('{config}/{path?}', 'UploadController@upload')->where('path', '(.*)');
});

Route::get('filer/download/{path?}', 'FileController@download')->where('path', '(.*)');
Route::get('filer/display/{path?}', 'FileController@display')->where('path', '(.*)');
