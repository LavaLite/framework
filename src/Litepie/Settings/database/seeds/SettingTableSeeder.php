<?php

namespace Litepie;

use DB;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('settings')->insert([
            [
                'package'   => 'Main',
                'module'    => 'Company',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'main.company.name',
                'name'      => 'Company name',
                'value'     => 'Lavalite',
                'type'      => 'Lavalite',
                'control'   => 'text',
            ],
            [
                'package'   => 'Main',
                'module'    => 'Company',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'main.company.address',
                'name'      => 'Company address',
                'value'     => 'Some value',
                'type'      => '3481 Melrose Place <br>
Beverly Hills, CA 90210',
                'control'   => 'text',
            ],
            [
                'package'   => 'Main',
                'module'    => 'Company',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'main.company.email',
                'name'      => 'Company address',
                'value'     => 'Company Email',
                'type'      => 'info@lavalite.org',
                'control'   => 'text',
            ],
            [
                'package'   => 'Main',
                'module'    => 'Company',
                'user_type' => null,
                'user_id'   => null,
                'key'       => 'main.company.logo',
                'name'      => 'Company logo',
                'value'     => 'Some value',
                'type'      => 'img/logo.png',
                'control'   => 'text',
            ],
        ]);
    }
}
