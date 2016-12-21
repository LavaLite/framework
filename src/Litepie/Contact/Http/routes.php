<?php

// Admin web routes  for contact
Route::group(['prefix' => trans_setlocale() . '/admin/contact'], function () {
    Route::resource('contact', 'Litepie\Contact\Http\Controllers\ContactAdminController');
});

// Admin API routes  for contact
Route::group(['prefix' => trans_setlocale() . 'api/v1/admin/contact'], function () {
    Route::resource('contact', 'Litepie\Contact\Http\Controllers\ContactAdminApiController');
});

// User web routes for contact
Route::group(['prefix' => trans_setlocale() . '/user/contact'], function () {
    Route::resource('contact', 'Litepie\Contact\Http\Controllers\ContactUserController');
});

// User API routes for contact
Route::group(['prefix' => trans_setlocale() . 'api/v1/user/contact'], function () {
    Route::resource('contact', 'Litepie\Contact\Http\Controllers\ContactUserApiController');
});

// Public web routes for contact
Route::group(['prefix' => trans_setlocale() . '/contacts'], function () {
});

// Public API routes for contact
Route::group(['prefix' => trans_setlocale() . 'api/v1/contacts'], function () {
    Route::get('/', 'Litepie\Contact\Http\Controllers\ContactApiController@index');
    Route::get('/{slug?}', 'Litepie\Contact\Http\Controllers\ContactApiController@show');
});
