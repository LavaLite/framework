<?php

namespace Litepie\Role\Database\Seeders;

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
            [
                'id'   => 4,
                'slug' => 'client',
                'name' => 'Client',
            ],
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => 1,
                'role_id' => 1,
            ],
            [
                'user_id' => 1,
                'role_id' => 2,
            ],
            [
                'user_id' => 2,
                'role_id' => 3,
            ],
        ]);
    }
}
