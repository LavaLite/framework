<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([[
            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'title'         => ' UT PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'sed-ut-perspiciatis-unde-omnis-iste',
                'description'   => '<p>Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. </p><p>Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. Morbi in dui quis est pulvinar ullamcorper. Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales. I am not a great cook, </p><p>I am not a great artist, but I love art, and I love food, so I am the perfect traveller. - Michael Palin</p>',
                'image'         => '',
                'images'        => '[{"folder":"2016\\/07\\/21\\/105031622\\/images","file":"blog3.jpg","caption":"Blog3","time":"2016-07-21 10:50:38"},{"folder":"2016\\/07\\/21\\/105031622\\/images","file":"blog2.jpg","caption":"Blog2","time":"2016-07-21 10:50:41"},{"folder":"2016\\/07\\/21\\/105031622\\/images","file":"blog1.jpg","caption":"Blog1","time":"2016-07-21 10:50:43"}]',
                'published_on'  => '2016-07-19',
                'status'        => 'Show',
                'published'     => 'Yes',
                'upload_folder' => '2016/07/21/105031622',
                'created_at'    => '2016-07-21 16:21:14',
                'deleted_at'    => null, 'updated_at' => '2016-07-21 10:50:44'],
            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'title'         => 'SED UT PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'sed-ut-perspiciatis-unde-omnis-iste-2',
                'description'   => '<p>Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. </p><p>Morbi in dui quis est pulvinar ullamcorper.Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales.</p><p>I am not a great cook, I am not a great artist, but I love art, and I love food, so I am the perfect traveller.- Michael Palin</p>',
                'image'         => '',
                'images'        => '[{"folder":"2016\\/07\\/21\\/105018827\\/images","file":"blog5.jpg","caption":"Blog5","time":"2016-07-21 10:50:24"},{"folder":"2016\\/07\\/21\\/105018827\\/images","file":"blog4.jpg","caption":"Blog4","time":"2016-07-21 10:50:26"},{"folder":"2016\\/07\\/21\\/105018827\\/images","file":"blog3.jpg","caption":"Blog3","time":"2016-07-21 10:50:28"}]',
                'published_on'  => '2016-07-19',
                'status'        => 'Show',
                'published'     => 'Yes',
                'upload_folder' => '2016/07/21/105018827',
                'created_at'    => '2016-07-21 16:21:17',
                'deleted_at'    => null, 'updated_at' => '2016-07-21 10:50:29'],
            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'title'         => ' PERSPICIATIS UNDE OMNIS ISTE',
                'slug'          => 'perspiciatis-unde-omnis-iste',
                'description'   => '<p>Suspendisse in justo eu magna luctus suscipit. Sed lectus. Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris. \'</p><p>Morbi in dui quis est pulvinar ullamcorper. &nbsp;Nulla facilisi. Integer lacinia sollicitudin massa. Cras metus. Sed aliquet risus a tortor. Integer id quam. Morbi mi. Quisque nisl felis, venenatis tristique, dignissim in, ultrices sit amet, augue. Proin sodales libero eget ante. Nulla quam. Aenean laoreet. Vestibulum nisi lectus, commodo ac, facilisis ac, ultricies eu, pede. Ut orci risus, accumsan porttitor, cursus quis, aliquet eget, justo. Sed pretium blandit orci. Ut eu diam at pede suscipit sodales. </p><p>&nbsp;I am not a great cook, I am not a great artist, but I love art, and I love food, so I am the perfect traveller. &nbsp;- Michael Palin</p>',
                'image'         => '',
                'images'        => '[{"folder":"2016\\/07\\/21\\/104859517\\/images","file":"bg-1.jpg","caption":"Bg 1","time":"2016-07-21 10:49:38"},{"folder":"2016\\/07\\/21\\/104945843\\/images","file":"blog1.jpg","caption":"Blog1","time":"2016-07-21 10:50:06"},{"folder":"2016\\/07\\/21\\/104945843\\/images","file":"blog2.jpg","caption":"Blog2","time":"2016-07-21 10:50:09"},{"folder":"2016\\/07\\/21\\/104945843\\/images","file":"blog3.jpg","caption":"Blog3","time":"2016-07-21 10:50:13"}]',
                'published_on'  => '2016-07-19',
                'status'        => 'Show',
                'published'     => 'Yes',
                'upload_folder' => '2016/07/21/104945843',
                'created_at'    => '2016-07-21 16:21:20',
                'deleted_at'    => null, 
                'updated_at' => '2016-07-21 10:50:15'],
        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'contact.contact.view',
                'name' => 'View Contact',
            ],
            [
                'slug' => 'contact.contact.create',
                'name' => 'Create Contact',
            ],
            [
                'slug' => 'contact.contact.edit',
                'name' => 'Update Contact',
            ],
            [
                'slug' => 'contact.contact.delete',
                'name' => 'Delete Contact',
            ],

        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/contact/contact',
                'name'        => 'Contact',
                'description' => null,
                'icon'        => 'fa fa-newspaper-o',
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'contact',
                'name'        => 'Contact',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],

        ]);

    }
}
