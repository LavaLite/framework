<?php

Route::group([
    'namespace' => '\\App\\Http\\Controllers\Auth\Api',
    'prefix' => '{guard?}'
], function () {
        Route::post('login', 'LoginController@apiLogin');
});
