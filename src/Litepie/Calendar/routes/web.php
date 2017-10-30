<?php

// Admin web routes  for calendar
Route::group(['prefix' => set_route_guard('web') . '/calendar'], function () {
    Route::get('calendar/ajax/list', 'CalendarResourceController@calendarList');
    Route::get('calendar/draft', 'CalendarResourceController@draft');
    Route::resource('calendar', 'CalendarResourceController');
});

Route::get('/calendars', 'CalendarPublicController@index');
Route::get('/calendar/{slug?}', 'CalendarPublicController@show');


