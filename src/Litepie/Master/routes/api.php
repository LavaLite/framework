<?php

// API routes  for master
require __DIR__ . '/routes.php';

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where' => [
                'trans' => Trans::keys('|'),
            ],
        ],
        function () {
            require __DIR__ . '/routes.php';
        }
    );
}
