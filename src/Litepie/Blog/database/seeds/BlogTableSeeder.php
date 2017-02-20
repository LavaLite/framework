<?php

use Illuminate\Database\Seeder;

class BlogTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blogs')->insert([

            [
                'category_id'   => '2',
                'title'         => 'SED UT PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'sed-ut-perspiciatis-unde-omnis-iste',
                'details'   => 'Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper.Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales.I am not a great cook, I am not a great artist, but I love art, and I love food, so I am the perfect traveller.- Michael Palin',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/120649337',
                'images'        => '[{"folder":"2016\\/07\\/21\\/120649337\\/images","file":"blog1.jpg","caption":"Blog1","time":"2016-07-21 12:07:06"},{"folder":"2016\\/07\\/21\\/120649337\\/images","file":"blog2.jpg","caption":"Blog2","time":"2016-07-21 12:07:07"},{"folder":"2016\\/07\\/21\\/120649337\\/images","file":"blog3.jpg","caption":"Blog3","time":"2016-07-21 12:07:07"}]',
                'viewcount'     => '0',
                'status'        => 'Show',
                'posted_on'     => '2016-07-19',
                'created_at'    => '2016-07-19 07:55:47',
                'updated_at'    => '2016-07-21 12:07:09',
                'deleted_at'    => null,
            ],
            [
                'category_id'   => '2',
                'title'         => 'SED UT PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'sed-ut-perspiciatis-unde-omnis-iste-2',
                'details'   => 'Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales. I am not a great cook, I am not a great artist, but I love art, and I love food, so I am the perfect traveller. - Michael Palin',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/120721471',
                'images'        => '[{"folder":"2016\\/07\\/21\\/120721471\\/images","file":"blog3.jpg","caption":"Blog3","time":"2016-07-21 12:07:36"},{"folder":"2016\\/07\\/21\\/120721471\\/images","file":"blog4.jpg","caption":"Blog4","time":"2016-07-21 12:07:36"},{"folder":"2016\\/07\\/21\\/120721471\\/images","file":"blog5.jpg","caption":"Blog5","time":"2016-07-21 12:07:36"}]',
                'viewcount'     => '0',
                'status'        => 'Show',
                'posted_on'     => '2016-07-19',
                'created_at'    => '2016-07-19 08:01:27',
                'updated_at'    => '2016-07-21 12:07:40',
                'deleted_at'    => null,
            ],
            [
                'category_id'   => '1',
                'title'         => 'SED UT PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'sed-ut-perspiciatis-unde-omnis-iste-3',
                'details'   => 'Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper.

Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales.

I am not a great cook, I am not a great artist, but I love art, and I love food, so I am the perfect traveller.

- Michael Palin',
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'upload_folder' => '2016/07/21/120743469',
                'images'        => '[{"caption":"Blog1","folder":"2016\\/07\\/21\\/120743469\\/images","time":"2016-07-21 12:07:58","file":"blog1.jpg"},{"caption":"Blog3","folder":"2016\\/07\\/21\\/120743469\\/images","time":"2016-07-21 12:07:58","file":"blog3.jpg"},{"folder":"2016\\/07\\/21\\/120743469\\/images","file":"blog2.jpg","caption":"Blog2","time":"2016-07-21 12:08:19"}]',
                'viewcount'     => '0',
                'status'        => 'Show',
                'posted_on'     => '2016-07-19',
                'created_at'    => '2016-07-19 08:03:14',
                'updated_at'    => '2016-07-21 12:08:22',
                'deleted_at'    => null,
            ],

        ]);

        DB::table('blog_categories')->insert([
            [
                'user_id'    => '1',
                'user_type'  => 'App\\User',
                'slug'       => 'family',
                'name'       => 'FAMILY',
                'status'     => 'Show',
                'created_at' => '2016-07-20 07:17:00',
                'updated_at' => '2016-07-20 07:17:00',
                'deleted_at' => null],
            [
                'user_id'    => '1',
                'user_type'  => 'App\\User',
                'slug'       => 'adventure',
                'name'       => 'ADVENTURE',
                'status'     => 'Show',
                'created_at' => '2016-07-20 07:17:48',
                'updated_at' => '2016-07-20 07:17:48',
                'deleted_at' => null],
            [
                'user_id'    => '1',
                'user_type'  => 'App\\User',
                'slug'       => 'romantic',
                'name'       => 'ROMANTIC',
                'status'     => 'Show',
                'created_at' => '2016-07-20 07:18:13',
                'updated_at' => '2016-07-20 07:18:13',
                'deleted_at' => null],
            [
                'user_id'    => '1',
                'user_type'  => 'App\\User',
                'slug'       => 'wildlife',
                'name'       => 'WILDLIFE',
                'status'     => 'Show',
                'created_at' => '2016-07-20 07:18:46',
                'updated_at' => '2016-07-20 07:18:46',
                'deleted_at' => null],
            [
                'user_id'    => '1',
                'user_type'  => 'App\\User',
                'slug'       => 'beach',
                'name'       => 'BEACH',
                'status'     => 'Show',
                'created_at' => '2016-07-20 07:19:30',
                'updated_at' => '2016-07-20 07:19:30',
                'deleted_at' => null],
        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'blog.blog.view',
                'name' => 'View Blog',
            ],
            [
                'slug' => 'blog.blog.create',
                'name' => 'Create Blog',
            ],
            [
                'slug' => 'blog.blog.edit',
                'name' => 'Update Blog',
            ],
            [
                'slug' => 'blog.blog.delete',
                'name' => 'Delete Blog',
            ],
            [
                'slug' => 'blog.category.view',
                'name' => 'View Category',
            ],
            [
                'slug' => 'blog.category.create',
                'name' => 'Create Category',
            ],
            [
                'slug' => 'blog.category.edit',
                'name' => 'Update Category',
            ],
            [
                'slug' => 'blog.category.delete',
                'name' => 'Delete Category',
            ],
        ]);


        $id = DB::table('menus')->insertGetId([
            'parent_id' => 1,
            'key'       => null,
            'url'       => 'admin/blog',
            'name'      => 'Blogs',
            'icon'      => 'fa fa-th-large',
            'target'    => null,
            'order'     => 100,
            'status'    => 1,
        ]);

        DB::table('menus')->insert([
            [
                'parent_id' => $id,
                'key'       => null,
                'url'       => 'admin/blog/blog',
                'name'      => 'Blogs',
                'icon'      => 'fa fa-th-large',
                'target'    => null,
                'order'     => 101,
                'status'    => 1,
            ],
            [
                'parent_id' => $id,
                'key'       => null,
                'url'       => 'admin/blog/category',
                'name'      => 'Categories',
                'icon'      => 'fa fa-bars',
                'target'    => null,
                'order'     => 102,
                'status'    => 1,
            ],
        ]);

        DB::table('settings')->insert([

        ]);
    }
}