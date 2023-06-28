<?php

namespace Litepie\Team\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->insert([
            [
                'key' => 'default',
                'level' => '1',
                'name' => 'Default',
                'type' => 'Default',
                'description' => 'Default Team',
                'status' => 'Active',
            ],
        ]);

    }
}
