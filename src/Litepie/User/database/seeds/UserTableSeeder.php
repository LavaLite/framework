<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'          => 1,
                'email'       => 'superuser@superuser.com',
                'password'    => '$2y$10$bKwW6PzSa1GDOeUTqtTaLOVMutZ12ObeslBfEXPx2pJAL/2B8aB06',
                'status'      => 'Active',
                'name'        => 'Super User',
                'sex'         => 'Male',
                'dob'         => '2014-05-15',
                'api_token'   => str_random(60),
                'designation' => 'Super User',
                'web'         => 'http://litepie.org',
                'created_at'  => '2015-09-15',
            ],
            [
                'id'          => 2,
                'email'       => 'admin@admin.com',
                'password'    => '$2y$10$T9DqgU3OlGOHHBKRL/tS4.CXyx6VZ.HhlT.otvMWk55zQ3EZB8Sze',
                'status'      => 'Active',
                'name'        => 'Admin',
                'sex'         => 'Male',
                'dob'         => '20-05-15',
                'api_token'   => str_random(60),
                'designation' => 'Admin',
                'web'         => 'http://litepie.org',
                'created_at'  => '2015-09-15',
            ],
            [
                'id'          => 3,
                'email'       => 'user@user.com',
                'password'    => '$2y$10$WgdW0SZkx3wlT52nroRGquai2P3l0MSU3vozQLrWgfFpJVxS4R6ky',
                'status'      => 'Active',
                'name'        => 'User',
                'sex'         => 'Male',
                'dob'         => '2014-05-15',
                'api_token'   => str_random(60),
                'designation' => 'User',
                'web'         => 'http://litepie.org',
                'created_at'  => '2015-09-15',
            ],
        ]);


        DB::table('menus')->insert([
            'parent_id'   => 2,
            'key'         => null,
            'url'         => 'home',
            'name'        => 'Dashborad',
            'description' => null,
            'icon'        => 'pe-7s-graph',
            'target'      => null,
            'status'      => 1,
        ]);

        $id = DB::table('menus')->insertGetId([
            'parent_id'   => 1,
            'key'         => null,
            'url'         => 'admin/user/user',
            'name'        => 'User',
            'description' => null,
            'icon'        => 'fa fa-users',
            'target'      => null,
            'order'       => 190,
            'status'      => 1,
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => $id,
                'key'         => null,
                'url'         => 'admin/user/user',
                'name'        => 'Users',
                'description' => null,
                'icon'        => 'fa fa-user',
                'target'      => null,
                'order'       => 1200,
                'status'      => 1,
            ],

            [
                'parent_id'   => $id,
                'key'         => null,
                'url'         => 'admin/user/role',
                'name'        => 'Roles',
                'description' => null,
                'icon'        => 'fa fa-thumbs-up',
                'target'      => null,
                'order'       => 1201,
                'status'      => 1,
            ],

            [
                'parent_id'   => $id,
                'key'         => null,
                'url'         => 'admin/user/permission',
                'name'        => 'Permissions',
                'description' => null,
                'icon'        => 'fa fa-check-circle-o',
                'target'      => null,
                'order'       => 1202,
                'status'      => 1,
            ],
            [
                'parent_id'   => $id,
                'key'         => null,
                'url'         => 'admin/user/team',
                'name'        => 'Team',
                'description' => null,
                'icon'        => 'fa fa-users',
                'target'      => null,
                'order'       => 1202,
                'status'      => 1,
            ],
        ]);
    }
}
