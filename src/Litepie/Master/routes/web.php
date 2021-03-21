<?php

// Resource routes for master
require __DIR__ . '/routes.php';

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
        ],
        function () {
            require __DIR__ . '/routes.php';
        }
    );
}
