<?php

// Resource routes  for role
Route::group(['prefix' => '{guard}/roles'], function () {
    Route::resource('permission', 'PermissionResourceController');
    Route::resource('role', 'RoleResourceController');
});

if (Trans::isMultilingual()) {
    Route::group(
        [
            'prefix' => '{trans}',
            'where'  => ['trans' => Trans::keys('|')],
        ],
        function () {
            Route::group(['prefix' => '{guard}/roles'], function () {
                Route::resource('permission', 'PermissionResourceController');
                Route::resource('role', 'RoleResourceController');
            });
        }
    );
}
