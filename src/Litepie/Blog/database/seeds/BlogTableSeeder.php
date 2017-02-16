<?php

use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'blog.blog.view',
                'name'      => 'View Blog',
            ],
            [
                'slug'      => 'blog.blog.create',
                'name'      => 'Create Blog',
            ],
            [
                'slug'      => 'blog.blog.edit',
                'name'      => 'Update Blog',
            ],
            [
                'slug'      => 'blog.blog.delete',
                'name'      => 'Delete Blog',
            ],
            /*
            [
                'slug'      => 'blog.blog.verify',
                'name'      => 'Verify Blog',
            ],
            [
                'slug'      => 'blog.blog.approve',
                'name'      => 'Approve Blog',
            ],
            [
                'slug'      => 'blog.blog.publish',
                'name'      => 'Publish Blog',
            ],
            [
                'slug'      => 'blog.blog.unpublish',
                'name'      => 'Unpublish Blog',
            ],
            [
                'slug'      => 'blog.blog.cancel',
                'name'      => 'Cancel Blog',
            ],
            [
                'slug'      => 'blog.blog.archive',
                'name'      => 'Archive Blog',
            ],
            */
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/blog/blog',
                'name'        => 'Blog',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/blog/blog',
                'name'        => 'Blog',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'blog',
                'name'        => 'Blog',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'blog.blog.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
