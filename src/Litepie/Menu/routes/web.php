<?php

// Web routes  for menu.

include('routes.php');


if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            include('routes.php');

        }
    );
}