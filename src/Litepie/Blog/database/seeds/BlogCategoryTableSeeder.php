<?php

use Illuminate\Database\Seeder;

class BlogCategoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blog_categories')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'blog.blog_category.view',
                'name'      => 'View BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.create',
                'name'      => 'Create BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.edit',
                'name'      => 'Update BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.delete',
                'name'      => 'Delete BlogCategory',
            ],
            /*
            [
                'slug'      => 'blog.blog_category.verify',
                'name'      => 'Verify BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.approve',
                'name'      => 'Approve BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.publish',
                'name'      => 'Publish BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.unpublish',
                'name'      => 'Unpublish BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.cancel',
                'name'      => 'Cancel BlogCategory',
            ],
            [
                'slug'      => 'blog.blog_category.archive',
                'name'      => 'Archive BlogCategory',
            ],
            */
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/blog/blog_category',
                'name'        => 'BlogCategory',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/blog/blog_category',
                'name'        => 'BlogCategory',
                'description' => null,
                'icon'        => 'icon-book-open',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'blog_category',
                'name'        => 'BlogCategory',
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
                'key'      => 'blog.blog_category.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
