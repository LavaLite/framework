<?php

Route::group(['middleware' => ['web']], function () {
    // File upload routes
    Route::post('upload/{config}/{path?}', 'UploadController@upload')->where('path', '(.*)');
});
