<?php

use Illuminate\Database\Seeder;

class TeamTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teams')->insert([
            [
                'slug'          => 'default',
                'name'          => 'Default',
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'user.team.view',
                'name'      => 'View Team',
            ],
            [
                'slug'      => 'user.team.create',
                'name'      => 'Create Team',
            ],
            [
                'slug'      => 'user.team.edit',
                'name'      => 'Update Team',
            ],
            [
                'slug'      => 'user.team.delete',
                'name'      => 'Delete Team',
            ],
            /*
            [
                'slug'      => 'user.team.verify',
                'name'      => 'Verify Team',
            ],
            [
                'slug'      => 'user.team.approve',
                'name'      => 'Approve Team',
            ],
            [
                'slug'      => 'user.team.publish',
                'name'      => 'Publish Team',
            ],
            [
                'slug'      => 'user.team.unpublish',
                'name'      => 'Unpublish Team',
            ],
            [
                'slug'      => 'user.team.cancel',
                'name'      => 'Cancel Team',
            ],
            [
                'slug'      => 'user.team.archive',
                'name'      => 'Archive Team',
            ],
            */
        ]);


        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'user.team.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
