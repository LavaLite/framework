<?php

namespace Litepie;

use DB;
use Illuminate\Database\Seeder;

class CalendarTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('calendars')->insert([
            [

                'user_type'     => 'App\\User',
                'user_id'       => '1',
                'status'        => 'Calendar',
                'start'         => '2016-07-19 00:00:00',
                'end'           => '2016-07-19 01:00:00',
                'location'      => null,
                'color'         => 'rgb(60, 141, 188)',
                'title'         => 'Board Meeting',
                'details'       => null,
                'created_by'    => null,
                'slug'          => 'board-meeting',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 08:35:17',
                'updated_at'    => '2016-07-20 08:38:08',
            ],
            [
                'user_type'     => 'App\\User',
                'user_id'       => '1',
                'status'        => 'Calendar',
                'start'         => '2016-07-29 00:00:00',
                'end'           => '2016-07-29 01:00:00',
                'location'      => null,
                'color'         => 'rgb(255, 0, 128)',
                'title'         => 'ALEXUS bday',
                'details'       => null,
                'created_by'    => null,
                'slug'          => 'alexus-bday',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 08:36:42',
                'updated_at'    => '2016-07-20 08:38:30',
            ],
            [
                'user_type'     => 'App\\User',
                'user_id'       => '1',
                'status'        => 'Calendar',
                'start'         => '2016-07-20 00:00:00',
                'end'           => '2016-07-20 01:00:00',
                'location'      => null,
                'color'         => 'rgb(255, 133, 27)',
                'title'         => 'Conference',
                'details'       => null,
                'created_by'    => null,
                'slug'          => 'conference',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 08:37:12',
                'updated_at'    => '2016-07-20 08:37:37',
            ],
            [
                'user_type'     => 'App\\User',
                'user_id'       => '1',
                'status'        => 'Calendar',
                'start'         => '2016-07-08 00:00:00',
                'end'           => '2016-07-08 01:00:00',
                'location'      => null,
                'color'         => 'rgb(57, 204, 204)',
                'title'         => 'Company meeting',
                'details'       => null,
                'created_by'    => null,
                'slug'          => 'company-meeting',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 08:37:28',
                'updated_at'    => '2016-07-20 08:37:33',
            ],

        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/calendar/calendar',
                'name'        => 'Calendars',
                'description' => null,
                'icon'        => 'fa fa-calendar',
                'target'      => null,
                'order'       => 120,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/calendar/calendar',
                'name'        => 'Calendars',
                'description' => null,
                'icon'        => 'date_range',
                'target'      => null,
                'order'       => 120,
                'status'      => 1,
            ]

        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'calendar.calendar.view',
                'name' => 'View Calendar',
            ],
            [
                'slug' => 'calendar.calendar.create',
                'name' => 'Create Calendar',
            ],
            [
                'slug' => 'calendar.calendar.edit',
                'name' => 'Update Calendar',
            ],
            [
                'slug' => 'calendar.calendar.delete',
                'name' => 'Delete Calendar',
            ],
        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
        [
        'key'      => 'calendar.calendar.key',
        'name'     => 'Some name',
        'value'    => 'Some value',
        'type'     => 'Default',
        ],
         */
        ]);
    }
}
