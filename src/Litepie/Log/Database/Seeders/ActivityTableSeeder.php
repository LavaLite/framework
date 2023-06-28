<?php

namespace Litepie\Log\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ActivityTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('litepie_log_activities')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'litepie.log.activity.view',
                'name'      => 'View Activity',
            ],
            [
                'slug'      => 'litepie.log.activity.create',
                'name'      => 'Create Activity',
            ],
            [
                'slug'      => 'litepie.log.activity.edit',
                'name'      => 'Update Activity',
            ],
            [
                'slug'      => 'litepie.log.activity.delete',
                'name'      => 'Delete Activity',
            ],
            
            
                    ]);

        DB::table('menus')->insert([
        
            // Admin menu
            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/log/activity',
                'name'        => 'Activity',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],
            
            // User menu.
            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/log/activity',
                'name'        => 'Activity',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            // Public menu.
            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'activity',
                'name'        => 'Activity',
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
                'pacakge'   => 'Log',
                'module'    => 'Activity',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'litepie.log.activity.key',
                'name'      => 'Some name',
                'value'     => 'Some value',
                'type'      => 'Default',
                'control'   => 'text',
            ],
            */
        ]);
    }
}
