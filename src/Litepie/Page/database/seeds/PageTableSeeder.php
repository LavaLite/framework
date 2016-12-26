<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('pages')->insert([

            [
                'id'               => 1,
                'name'             => 'Home',
                'slug'             => 'home',
                'heading'          => 'Home',
                'title'            => 'Home',
                'content'          => 'Home Page',
                'meta_title'       => null,
                'meta_keyword'     => null,
                'meta_description' => null,
                'images'           => null,
                'abstract'         => null,
                'order'            => 0,
                'banner'           => null,
                'view'             => 'page',
                'compiler'         => null,
                'status'           => 1,
            ],

            [
                'id'               => 2,
                'name'             => 'About Us',
                'slug'             => 'about-us',
                'heading'          => 'About Us',
                'title'            => 'About Us',
                'content'          => '<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe nostrum ullam eveniet pariatur voluptates odit, fuga atque ea nobis sit soluta odio, adipisci quas excepturi maxime quae totam ducimus consectetur?</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius praesentium recusandae illo eaque architecto error, repellendus iusto reprehenderit, doloribus, minus sunt. Numquam at quae voluptatum in officia voluptas voluptatibus, minus! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum molestiae debitis nobis, quod sapiente qui voluptatum, placeat magni repudiandae accusantium fugit quas labore non rerum possimus, corrupti enim modi! Et.</p>
<p><span style="font-size: 24px;">Stay in Touch</span></p>
<p>Lorem ipsum dolor sit amet, has facer euismod hendrerit cu. Ei zril aliquid iudicabit has, et duo tollit oportere. Ex eos admodum accumsan prodesset, vel ex accusam accusamus. Zril integre voluptua vis ea, labore conclusionemque te vim. Ei suas vivendum neglegentur vel, ipsum aliquam has ne.</p>
<p>Nulla facilisi. Phasellus auctor tortor in libero fermentum, at fringilla lectus porta. In hac habitasse platea dictumst. Aenean tristique ante a enim aliquam eleifend.</p>
<p><span style="font-size: 24px;">Mission&nbsp;</span></p>
<p>Lorem ipsum dolor sit amet, has facer euismod hendrerit cu. Ei zril aliquid iudicabit has, et duo tollit oportere. Ex eos admodum accumsan prodesset, vel ex accusam accusamus. Zril integre voluptua vis ea, labore conclusionemque te vim. Ei suas vivendum neglegentur vel, ipsum aliquam has ne.</p>
<p><span style="font-size: 24px;">Vision</span></p>
<p>Nulla facilisi. Phasellus auctor tortor in libero fermentum, at fringilla lectus porta. In hac habitasse platea dictumst. Aenean tristique ante a enim aliquam eleifend.</p>
</div>',
                'meta_title'       => null,
                'meta_keyword'     => null,
                'meta_description' => null,
                'images'           => null,
                'abstract'         => null,
                'order'            => 0,
                'banner'           => null,
                'view'             => 'page',
                'compiler'         => null,
                'status'           => 1,
            ],

            [
                'id'               => 3,
                'name'             => 'Contact Us',
                'heading'          => 'Contact Us',
                'title'            => 'Contact Us',
                'content'          => '<p><br></p>',
                'meta_title'       => null,
                'meta_keyword'     => null,
                'meta_description' => null,
                'images'           => null,
                'abstract'         => null,
                'slug'             => 'contact',
                'order'            => 0,
                'banner'           => null,
                'view'             => 'page',
                'compiler'         => null,
                'status'           => 1,
            ],

            [
                'id'               => 4,
                'name'             => 'Page Not found',
                'heading'          => 'Page Not found',
                'title'            => 'Page Not found',
                'content'          => '<p><br></p>',
                'meta_title'       => null,
                'meta_keyword'     => null,
                'meta_description' => null,
                'images'           => null,
                'abstract'         => null,
                'slug'             => 404,
                'order'            => 0,
                'banner'           => null,
                'view'             => 'page',
                'compiler'         => null,
                'status'           => 1,
            ],

        ]);

        DB::table('menus')->insert([
            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/page/page',
                'name'        => 'Pages',
                'description' => null,
                'icon'        => 'fa fa-book',
                'target'      => null,
                'order'       => 5,
                'status'      => 1,
            ],

            [
                'parent_id'   => 4,
                'key'         => null,
                'url'         => 'about-us.html',
                'name'        => 'About Us',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 8,
                'status'      => 1,
            ],
        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'page.page.view',
                'name' => 'View Page',
            ],
            [
                'slug' => 'page.page.create',
                'name' => 'Create Page',
            ],
            [
                'slug' => 'page.page.edit',
                'name' => 'Update Page',
            ],
            [
                'slug' => 'page.page.delete',
                'name' => 'Delete Page',
            ],
        ]);
    }
}
