<?php

use Illuminate\Database\Seeder;

class BlockTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blocks')->insert([
            [
                'category_id'   => '1',
                'name'          => 'Powered by Laravel 5.3',
                'url'           => '',
                'icon'          => 'ion ion-social-github-outline',
                'order'         => '0',
                'description'   => 'We have tried to make use of all features of Laravel 5.2 which help you to develop the website with all resources available online.​ ',
                'image'         => '',
                'images'        => '',
                'published'     => 'Yes',
                'slug'          => 'powered-by-laravel-5-3',
                'status'        => 'show',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/104902202',
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 00:00:00',
                'updated_at'    => '2016-11-01 16:07:21',
            ],
            [
                'category_id'   => '1',
                'name'          => 'Configure to your project',
                'url'           => '',
                'icon'          => 'ion ion-ios-gear-outline',
                'order'         => '0',
                'description'   => 'Lavalite helps you to configure your Laravel projects easily. It acts as a bootstrapper for your Laravel Content Management System.',
                'image'         => '',
                'images'        => ']',
                'published'     => 'Yes',
                'slug'          => 'configure-to-your-project',
                'status'        => 'show',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/104854884',
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 00:00:00',
                'updated_at'    => '2016-11-01 16:08:00',
            ],
            [
                'category_id'   => '1',
                'name'          => 'Online package builder',
                'url'           => '',
                'icon'          => 'ion ion-ios-checkmark-outline',
                'order'         => '0',
                'description'   => 'The online package builder helps you to build Lavalite packages easily, The downloaded package with basic required files help you to finish your projects quickly.',
                'image'         => '',
                'images'        => '',
                'published'     => 'Yes',
                'slug'          => 'online-package-builder',
                'status'        => 'show',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/104846403',
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 00:00:00',
                'updated_at'    => '2016-11-01 16:08:29',
            ],
        ]);

        DB::table('block_categories')->insert([
            [
                'id'            => '1',
                'name'          => 'Features',
                'slug'          => 'features',
                'title'         => 'Packed with features you can\'t live without.',
                'details'       => 'Visit our <a href="https://github.com/LavaLite/cms/wiki">documentation</a> for more information.',
                'status'        => 'show',
                'user_type'     => 'App\\User',
                'user_id'       => '1',
                'upload_folder' => '2016/10/31/163917964',
                'deleted_at'    => null,
                'created_at'    => '2016-07-20 07:17:48',
                'updated_at'    => '2016-11-01 13:08:17',
            ],
        ]);

        $id = DB::table('menus')->insertGetId([
            'parent_id' => 1,
            'key'       => null,
            'url'       => 'admin/block',
            'name'      => 'Blocks',
            'icon'      => 'fa fa-square',
            'target'    => null,
            'order'     => 100,
            'status'    => 1,
        ]);

        DB::table('menus')->insert([
            [
                'parent_id' => $id,
                'key'       => null,
                'url'       => 'admin/block/block',
                'name'      => 'Blocks',
                'icon'      => 'fa fa-square',
                'target'    => null,
                'order'     => 101,
                'status'    => 1,
            ],
            [
                'parent_id' => $id,
                'key'       => null,
                'url'       => 'admin/block/category',
                'name'      => 'Categories',
                'icon'      => 'fa fa-bars',
                'target'    => null,
                'order'     => 102,
                'status'    => 1,
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'block.block.view',
                'name' => 'View Block',
            ],
            [
                'slug' => 'block.block.create',
                'name' => 'Create Block',
            ],
            [
                'slug' => 'block.block.edit',
                'name' => 'Update Block',
            ],
            [
                'slug' => 'block.block.delete',
                'name' => 'Delete Block',
            ],
            [
                'slug' => 'block.category.view',
                'name' => 'View Category',
            ],

            [
                'slug' => 'block.category.create',
                'name' => 'Create Category',
            ],
            [
                'slug' => 'block.category.edit',
                'name' => 'Update Category',
            ],
            [
                'slug' => 'block.category.delete',
                'name' => 'Delete Category',
            ],
        ]);

    }
}
