<?php

Route::group(['prefix' => 'api/{guard}/upload'], function () {
    // File upload routes
    Route::post('{config}/{path?}', 'FileController@upload')->where('path', '(.*)');
});
