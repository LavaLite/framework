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
                'role_id' => 2,
            ],
        ]);

        $id = DB::table('menus')->insertGetId(
            [
                'parent_id'   => 1,
                'key'         => 'role',
                'url'         => 'admin/roles/role',
                'name'        => 'Role',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'role'        => '["superuser"]',
                'order'       => 190,
                'status'      => 1,
            ]
        );

        DB::table('menus')->insert([

            [
                'parent_id'   => $id,
                'key'         => 'role',
                'url'         => 'admin/roles/role',
                'name'        => 'Role',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'role'        => '["superuser"]',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);
    }
}
