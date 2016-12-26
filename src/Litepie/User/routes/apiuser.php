<?php

Route::group([
    'namespace' => '\\App\\Http\\Controllers\Auth\Api',
    'prefix' => '{guard}'
], function () {
        Route::get('authenticate', 'LoginController@apiLogin');
});
