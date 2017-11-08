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
                'slug' => 'superuser',
                'name' => 'Super User',
            ],
            [
                'id'   => 2,
                'slug' => 'admin',
                'name' => 'Admin',
            ],
            [
                'id'   => 3,
                'slug' => 'user',
                'name' => 'User',
            ],
        ]);

        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1,
            ],
        ]);

    }
}
