<?php

namespace Litepie;

use DB;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        $id = DB::table('menus')->whereKey('role')->first()->id;

        DB::table('menus')->insert([
            [
                'parent_id'   => $id,
                'key'         => null,
                'url'         => 'admin/roles/permission',
                'name'        => 'Permission',
                'description' => null,
                'icon'        => 'fa fa-check-circle-o',
                'role'        => '["superuser"]',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],
        ]);
    }
}
