<?php

// Web routes  for user.

include('routes.php');


if (app('trans')->isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => app('trans')->keys('|')],
        ],
        function () {
            include('routes.php');

        }
    );
}