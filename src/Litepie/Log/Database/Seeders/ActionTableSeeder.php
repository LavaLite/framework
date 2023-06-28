<?php

namespace Litepie\Log\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ActionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('litepie_log_actions')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'litepie.log.action.view',
                'name'      => 'View Action',
            ],
            [
                'slug'      => 'litepie.log.action.create',
                'name'      => 'Create Action',
            ],
            [
                'slug'      => 'litepie.log.action.edit',
                'name'      => 'Update Action',
            ],
            [
                'slug'      => 'litepie.log.action.delete',
                'name'      => 'Delete Action',
            ],
            
            
                    ]);

        DB::table('menus')->insert([
        
            // Admin menu
            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/log/action',
                'name'        => 'Action',
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
                'url'         => 'user/log/action',
                'name'        => 'Action',
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
                'url'         => 'action',
                'name'        => 'Action',
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
                'module'    => 'Action',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'litepie.log.action.key',
                'name'      => 'Some name',
                'value'     => 'Some value',
                'type'      => 'Default',
                'control'   => 'text',
            ],
            */
        ]);
    }
}
