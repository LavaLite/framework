<?php

namespace Litepie\Master\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class MasterTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('litepie_master_masters')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'litepie.master.master.view',
                'name'      => 'View Master',
            ],
            [
                'slug'      => 'litepie.master.master.create',
                'name'      => 'Create Master',
            ],
            [
                'slug'      => 'litepie.master.master.edit',
                'name'      => 'Update Master',
            ],
            [
                'slug'      => 'litepie.master.master.delete',
                'name'      => 'Delete Master',
            ],
        ]);

        DB::table('menus')->insert([
        
            // Admin menu
            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/master/master',
                'name'        => 'Master',
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
                'url'         => 'user/master/master',
                'name'        => 'Master',
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
                'url'         => 'master',
                'name'        => 'Master',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            
        ]);
    }
}
