<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('roles')->insert([
            [
                'id'   => 1,
                'name' => 'superuser',
            ],
            [
                'id'   => 2,
                'name' => 'admin',
            ],
            [
                'id'   => 3,
                'name' => 'user',
            ],
        ]);

        DB::table('roleables')->insert([
            [
                'role_id'       => 1,
                'roleable_id'   => 1,
                'roleable_type' => 'App\\User',
            ],
            [
                'role_id'       => 2,
                'roleable_id'   => 1,
                'roleable_type' => 'App\\User',
            ],
            [
                'role_id'       => 2,
                'roleable_id'   => 2,
                'roleable_type' => 'App\\User',
            ],
            [
                'role_id'       => 3,
                'roleable_id'   => 3,
                'roleable_type' => 'App\\User',
            ],
            [
                'role_id'       => 1,
                'roleable_id'   => 1,
                'roleable_type' => 'App\\Client',
            ],
            [
                'role_id'       => 2,
                'roleable_id'   => 1,
                'roleable_type' => 'App\\Client',
            ],
            [
                'role_id'       => 2,
                'roleable_id'   => 2,
                'roleable_type' => 'App\\Client',
            ],
            [
                'role_id'       => 3,
                'roleable_id'   => 3,
                'roleable_type' => 'App\\Client',
            ],
        ]);
    }
}
