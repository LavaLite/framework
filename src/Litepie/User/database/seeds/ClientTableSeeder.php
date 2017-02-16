<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    public function run()
    {
        /*DB::table('clients')->insert([
            [
                'id'          => 1,
                'email'       => 'client@client.com',
                'status'      => 'Active',
                'name'        => 'Client',
                'sex'         => 'Male',
                'dob'         => '2014-05-15',
                'api_token'   => str_random(60),
                'designation' => 'Super User',
                'web'         => 'http://litepie.org',
                'created_at'  => '2015-09-15',
            ]
        ]);*/

        DB::table('menus')->insert([
            'parent_id'   => 3,
            'key'         => null,
            'url'         => 'client',
            'name'        => 'Dashborad',
            'description' => null,
            'icon'        => 'pe-7s-graph',
            'target'      => null,
            'status'      => 1,
        ]);

    }
}
