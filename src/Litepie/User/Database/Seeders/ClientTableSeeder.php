<?php

namespace Litepie\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('clients')->insert([
            [
                'id'                => 1,
                'email'             => 'client@lavalite.org',
                'password'          => bcrypt('client@lavalite'),
                'status'            => 'Active',
                'name'              => 'Client',
                'sex'               => 'Male',
                'dob'               => '2014-05-15',
                'designation'       => 'Super User',
                'email_verified_at' => '2019-04-15 00:00:00',
                'web'               => 'http://litepie.org',
                'created_at'        => '2015-09-15 00:00:00',
            ],
        ]);
    }
}
