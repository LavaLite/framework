<?php

use Illuminate\Database\Seeder;

class LitepieTeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->insert([
            [
                'id'     => 1,
                'name'   => 'Default',
                'status' => 'Active',
            ],
        ]);
    }
}
