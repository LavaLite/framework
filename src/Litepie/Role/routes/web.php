<?php

// Web routes  for role.

include 'routes.php';

if (app('trans')->isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => app('trans')->keys('|')],
        ],
        function () {
            include 'routes.php';
        }
    );
}
