<?php

use DB;
use Illuminate\Database\Seeder;

class LitepieNotificationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('notifications')->insert([

        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'alerts.notification.view',
                'name' => 'View Notification',
            ],
            [
                'slug' => 'alerts.notification.create',
                'name' => 'Create Notification',
            ],
            [
                'slug' => 'alerts.notification.edit',
                'name' => 'Update Notification',
            ],
            [
                'slug' => 'alerts.notification.delete',
                'name' => 'Delete Notification',
            ],
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/alerts/notification',
                'name'        => 'Notification',
                'description' => null,
                'icon'        => 'fa fa-bell-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/alerts/notification',
                'name'        => 'Notification',
                'description' => null,
                'icon'        => 'notifications',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'notification',
                'name'        => 'Notification',
                'description' => null,
                'icon'        => 'notifications',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
        [
        'key'      => 'alerts.notification.key',
        'name'     => 'Some name',
        'value'    => 'Some value',
        'type'     => 'Default',
        ],
         */
        ]);
    }
}
