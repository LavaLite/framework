<?php

// Admin web routes  for calendar
Route::group(['prefix' => trans_setlocale() . '/admin/calendar'], function () {
    Route::get('calendar/ajax/list', 'CalendarAdminController@calendarList');
    Route::get('calendar/draft', 'CalendarAdminController@draft');
    Route::resource('calendar', 'CalendarAdminController');
});



// User web routes for calendar
Route::group(['middleware'=>'web','prefix' => trans_setlocale() . '/user/calendar'], function () {
    Route::get('calendar/ajax/list', 'CalendarUserController@calendarList');
    Route::get('calendar/draft', 'CalendarUserController@draft');
    Route::resource('/calendar', 'CalendarUserController');
});

// User web routes for calendar
Route::group(['middleware'=>'web','prefix' => trans_setlocale() . '/client/calendar'], function () {
    Route::get('calendar/ajax/list', 'CalendarClientController@calendarList');
    Route::get('calendar/draft', 'CalendarClientController@draft');
    Route::resource('/calendar', 'CalendarClientController');
});



//  web routes for calendar
Route::group(['prefix' => trans_setlocale() . '/calendar'], function () {
    Route::get('/calendar', 'CalendarController@index');
    Route::get('/{slug?}', 'CalendarController@show');
});


