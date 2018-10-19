<?php

Route::group(['prefix' => set_route_guard('web').'/upload'], function () {
    // File upload routes
    Route::post('{config}/{path?}', 'UploadController@upload')->where('path', '(.*)');
});

Route::get('file/download/{path?}', 'FileController@download')->where('path', '(.*)');
Route::get('file/display/{path?}', 'FileController@display')->where('path', '(.*)');
