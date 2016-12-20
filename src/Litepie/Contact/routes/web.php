<?php

// Admin  routes  for contact
Route::group(['prefix' => '/admin/contact'], function () {
    Route::resource('contact', 'ContactAdminController');
});


Route::get('/contact.htm', 'ContactController@index');
Route::post('/contact.htm', 'ContactController@sendMail');

