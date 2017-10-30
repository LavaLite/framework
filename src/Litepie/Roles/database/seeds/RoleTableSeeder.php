<?php

namespace Litepie;

use DB;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'   => 1,
                'slug'  => 'superuser',
                'name' => 'superuser',
            ],
            [
                'id'   => 2,
                'slug'  => 'admin',
                'name' => 'admin',
            ],
            [
                'id'   => 3,
                'slug'  => 'user',
                'name' => 'user',
            ],
        ]);

    }
}
