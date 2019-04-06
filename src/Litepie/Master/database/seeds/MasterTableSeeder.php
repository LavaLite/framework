<?php

namespace Litepie;

use DB;
use Illuminate\Database\Seeder;

class MasterTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('masters')->insert([
            
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/masters',
                'name'        => 'Master',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

    }
}
