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
                'id'        => 1,
                'parent_id' => 0,
                'key'       => 'admin',
                'url'       => 'admin',
                'name'      => 'Admin',
                'icon'      => null,
                'target'    => null,
                'order'     => 1,
                'status'    => 1,
            ],

            [
                'id'          => 2,
                'parent_id'   => 0,
                'key'         => 'main',
                'url'         => '/',
                'name'        => 'Main Menu',
                'description' => 'Website main menu',
                'icon'        => null,
                'order'       => 2,
                'status'      => 1,
            ],

            [
                'id'          => 3,
                'parent_id'   => 0,
                'key'         => 'bottom',
                'url'         => '/',
                'name'        => 'Bottom',
                'description' => 'Bottom menu',
                'icon'        => null,
                'order'       => 3,
                'status'      => 1,
            ],

            [
                'id'        => 4,
                'parent_id' => 1,
                'key'       => 'content',
                'url'       => 'admin/page/page',
                'name'      => 'Content',
                'icon'      => 'fa fa-book',
                'order'     => 4,
                'status'    => 1,
            ],

            [
                'id'        => 5,
                'parent_id' => 4,
                'url'       => 'admin/page/page',
                'name'      => 'Pages',
                'icon'      => 'fa fa-book',
                'order'     => 5,
                'status'    => 1,
            ],

            [
                'id'        => 7,
                'parent_id' => 4,
                'url'       => 'admin/menu/menu',
                'name'      => 'Menu',
                'icon'      => 'fa fa-bars',
                'order'     => 6,
                'status'    => 1,
            ],

            [
                'id'        => 8,
                'parent_id' => 2,
                'url'       => '/',
                'name'      => 'Home',
                'icon'      => null,
                'order'     => 7,
                'status'    => 1,
            ],

            [
                'id'        => 9,
                'parent_id' => 2,
                'url'       => 'about-us.html',
                'name'      => 'About Us',
                'icon'      => null,
                'order'     => 8,
                'status'    => 1,
            ],

            [
                'id'        => 10,
                'parent_id' => 2,
                'url'       => 'contact.html',
                'name'      => 'Contact Us',
                'icon'      => null,
                'order'     => 9,
                'status'    => 1,
            ],

            [
                'id'        => 11,
                'parent_id' => 1,
                'url'       => 'admin',
                'name'      => 'Dashboard',
                'icon'      => 'fa fa-dashboard',
                'order'     => 3,
                'status'    => 1,
            ],

            [
                'id'        => 12,
                'parent_id' => 1,
                'url'       => 'admin/user/user',
                'name'      => 'Users',
                'icon'      => 'fa fa-users',
                'order'     => 11,
                'status'    => 1,
            ],

            [
                'id'        => 13,
                'parent_id' => 12,
                'url'       => 'admin/user/user',
                'name'      => 'Users',
                'icon'      => 'fa fa-users',
                'order'     => 12,
                'status'    => 1,
            ],

            [
                'id'        => 14,
                'parent_id' => 12,
                'url'       => 'admin/user/role',
                'name'      => 'Roles',
                'icon'      => 'fa fa-user-plus',
                'order'     => 13,
                'status'    => 1,
            ],

            [
                'id'        => 15,
                'parent_id' => 12,
                'url'       => 'admin/user/permission',
                'name'      => 'Permissions',
                'icon'      => 'fa fa-check-circle-o',
                'order'     => 14,
                'status'    => 1,
            ],

        ]);
    }
}
