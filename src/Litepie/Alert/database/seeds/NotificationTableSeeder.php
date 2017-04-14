<?php

use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('notifications')->insert([

        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'alert.notification.view',
                'name' => 'View Notification',
            ],
            [
                'slug' => 'alert.notification.create',
                'name' => 'Create Notification',
            ],
            [
                'slug' => 'alert.notification.edit',
                'name' => 'Update Notification',
            ],
            [
                'slug' => 'alert.notification.delete',
                'name' => 'Delete Notification',
            ],
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/alert/notification',
                'name'        => 'Notification',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/alert/notification',
                'name'        => 'Notification',
                'description' => null,
                'icon'        => 'pe-7s-speaker',
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
                'icon'        => 'pe-7s-speaker',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
        [
        'key'      => 'alert.notification.key',
        'name'     => 'Some name',
        'value'    => 'Some value',
        'type'     => 'Default',
        ],
         */
        ]);
    }
}
