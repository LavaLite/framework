<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'settings.setting.view',
                'name'      => 'View Setting',
            ],
            [
                'slug'      => 'settings.setting.create',
                'name'      => 'Create Setting',
            ],
            [
                'slug'      => 'settings.setting.edit',
                'name'      => 'Update Setting',
            ],
            [
                'slug'      => 'settings.setting.delete',
                'name'      => 'Delete Setting',
            ],
            /*
            [
                'slug'      => 'settings.setting.verify',
                'name'      => 'Verify Setting',
            ],
            [
                'slug'      => 'settings.setting.approve',
                'name'      => 'Approve Setting',
            ],
            [
                'slug'      => 'settings.setting.publish',
                'name'      => 'Publish Setting',
            ],
            [
                'slug'      => 'settings.setting.unpublish',
                'name'      => 'Unpublish Setting',
            ],
            [
                'slug'      => 'settings.setting.cancel',
                'name'      => 'Cancel Setting',
            ],
            [
                'slug'      => 'settings.setting.archive',
                'name'      => 'Archive Setting',
            ],
            */
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/settings/setting',
                'name'        => 'Setting',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/settings/setting',
                'name'        => 'Setting',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'setting',
                'name'        => 'Setting',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'settings.setting.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
