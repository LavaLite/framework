<?php

namespace Litepie\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'email' => 'admin@lavalite.org',
                'password' => bcrypt('admin@lavalite'),
                'status' => 'Active',
                'name' => 'Administrator',
                'sex' => 'Male',
                'dob' => '2014-05-15',
                'designation' => 'Super User',
                'web' => 'http://lavalite.org',
                'created_at' => '2015-09-15',
            ],
            [
                'id' => 2,
                'email' => 'user@lavalite.org',
                'password' => bcrypt('user@lavalite'),
                'status' => 'Active',
                'name' => 'User',
                'sex' => 'Male',
                'dob' => '2015-05-15',
                'designation' => 'Admin',
                'web' => 'http://lavalite.org',
                'created_at' => '2015-09-15',
            ],
        ]);

        DB::table('menus')->insert([
            'parent_id' => 2,
            'key' => null,
            'url' => 'user',
            'name' => 'Dashborad',
            'description' => null,
            'icon' => 'dashboard',
            'target' => null,
            'order' => 50,
            'status' => 1,
        ]);
    }
}