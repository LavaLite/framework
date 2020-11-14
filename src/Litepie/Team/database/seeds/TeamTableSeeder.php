<?php


use Illuminate\Database\Seeder;

class LitepieTeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->insert([
            [
                'id' => 1,
                'name' => 'Default',
                'status' => 'Active',
            ],
            [
                'id' => 2,
                'name' => 'Admin',
                'status' => 'Active',
            ],
            [
                'id' => 3,
                'name' => 'Manager',
                'status' => 'Active',
            ],
        ]);
    }
}
