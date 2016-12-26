<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'slug' => 'menu.menu.view',
                'name' => 'View Menu',
            ],
            [
                'slug' => 'menu.menu.create',
                'name' => 'Create Menu',
            ],
            [
                'slug' => 'menu.menu.edit',
                'name' => 'Update Menu',
            ],
            [
                'slug' => 'menu.menu.delete',
                'name' => 'Delete Menu',
            ],
        ]);

        DB::table('menus')->insert([

            [
                'id'          => 1,
                'parent_id'   => 0,
                'key'         => 'admin',
                'url'         => '/admin',
                'name'        => 'Admin',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'id'          => 2,
                'parent_id'   => 0,
                'key'         => 'user',
                'url'         => '/home',
                'name'        => 'User',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'id'          => 3,
                'parent_id'   => 0,
                'key'         => 'client',
                'url'         => '/client',
                'name'        => 'User',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'id'          => 4,
                'parent_id'   => 0,
                'key'         => 'main',
                'url'         => '',
                'name'        => 'Main Menu',
                'description' => 'Website main menu',
                'icon'        => null,
                'target'      => null,
                'order'       => 2,
                'status'      => 1,
            ],

            [
                'id'          => 5,
                'parent_id'   => 0,
                'key'         => 'footer',
                'url'         => '',
                'name'        => 'Footer',
                'description' => 'Footer menu',
                'icon'        => null,
                'target'      => null,
                'order'       => 3,
                'status'      => 1,
            ],

            [
                'id'          => 6,
                'parent_id'   => 0,
                'key'         => 'social',
                'url'         => '',
                'name'        => 'Social',
                'description' => 'Social media menu',
                'icon'        => null,
                'target'      => null,
                'order'       => 3,
                'status'      => 1,
            ],

            [
                'id'          => null,
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/menu/menu',
                'name'        => 'Menu',
                'description' => null,
                'icon'        => 'fa fa-bars',
                'target'      => null,
                'order'       => 6,
                'status'      => 1,
            ],

            [
                'id'          => null,
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin',
                'name'        => 'Dashboard',
                'description' => null,
                'icon'        => 'fa fa-dashboard',
                'target'      => null,
                'order'       => 1,
                'status'      => 1,
            ],

            [
                'id'          => null,
                'parent_id'   => 5,
                'key'         => null,
                'url'         => 'https://twitter.com/lavalitecms',
                'name'        => 'Twitter',
                'description' => null,
                'icon'        => null,
                'target'      => '_blank',
                'order'       => 11,
                'status'      => 1,
            ],

            [
                'id'          => null,
                'parent_id'   => 5,
                'key'         => null,
                'url'         => 'https://github.com/LavaLite',
                'name'        => 'GitHub',
                'description' => null,
                'icon'        => null,
                'target'      => '_blank',
                'order'       => 12,
                'status'      => 1,
            ],

            [
                'id'          => null,
                'parent_id'   => 5,
                'key'         => null,
                'url'         => 'https://www.facebook.com/lavalite/',
                'name'        => 'Facebook',
                'description' => null,
                'icon'        => null,
                'target'      => '_blank',
                'order'       => 13,
                'status'      => 1,
            ],

        ]);
    }
}
