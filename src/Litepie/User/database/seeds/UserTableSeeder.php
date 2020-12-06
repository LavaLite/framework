<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LitepieUserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id'                => 1,
                'email'             => 'admin@lavalite.org',
                'password'          => bcrypt('admin@lavalite'),
                'status'            => 'Active',
                'name'              => 'Administrator',
                'sex'               => 'Male',
                'dob'               => '2014-05-15',
                'api_token'         => Str::random(60),
                'email_verified_at' => '2019-04-15 00:00:00',
                'designation'       => 'Super User',
                'web'               => 'http://lavalite.org',
                'created_at'        => '2015-09-15',
            ],
            [
                'id'                => 2,
                'email'             => 'user@lavalite.org',
                'password'          => bcrypt('user@lavalite'),
                'status'            => 'Active',
                'name'              => 'User',
                'sex'               => 'Male',
                'dob'               => '2015-05-15',
                'api_token'         => Str::random(60),
                'email_verified_at' => '2019-04-15 00:00:00',
                'designation'       => 'Admin',
                'web'               => 'http://lavalite.org',
                'created_at'        => '2015-09-15',
            ],
        ]);

        DB::table('menus')->insert([
            'parent_id'   => 2,
            'key'         => null,
            'url'         => 'user',
            'name'        => 'Dashborad',
            'description' => null,
            'icon'        => 'dashboard',
            'target'      => null,
            'order'       => 50,
            'status'      => 1,
        ]);
        /*
                $id = DB::table('menus')->insertGetId([
                    'parent_id' => 1,
                    'key' => 'admin.user',
                    'url' => 'admin/user/user',
                    'name' => 'User',
                    'role' => '["superuser"]',
                    'description' => null,
                    'icon' => 'fa fa-users',
                    'target' => null,
                    'order' => 1999,
                    'status' => 1,
                ]);

                DB::table('menus')->insert([
                    [
                        'parent_id' => $id,
                        'key' => null,
                        'url' => 'admin/user/user',
                        'name' => 'Users',
                        'description' => null,
                        'icon' => 'fa fa-user',
                        'target' => null,
                        'order' => 1200,
                        'status' => 1,
                    ],
                    [
                        'parent_id' => $id,
                        'key' => null,
                        'url' => 'admin/user/client',
                        'name' => 'Clients',
                        'description' => null,
                        'icon' => 'fa fa-user',
                        'target' => null,
                        'order' => 1202,
                        'status' => 1,
                    ],
                    [
                        'parent_id' => $id,
                        'key' => null,
                        'url' => 'admin/user/team',
                        'name' => 'Teams',
                        'description' => null,
                        'icon' => 'fa fa-users',
                        'target' => null,
                        'order' => 1204,
                        'status' => 1,
                    ],
                ]);
        */
    }
}
