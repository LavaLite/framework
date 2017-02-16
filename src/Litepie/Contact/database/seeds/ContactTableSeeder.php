<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            
        ]);

        DB::table('permissions')->insert([
            [
                'slug'      => 'contact.contact.view',
                'name'      => 'View Contact',
            ],
            [
                'slug'      => 'contact.contact.create',
                'name'      => 'Create Contact',
            ],
            [
                'slug'      => 'contact.contact.edit',
                'name'      => 'Update Contact',
            ],
            [
                'slug'      => 'contact.contact.delete',
                'name'      => 'Delete Contact',
            ],
            /*
            [
                'slug'      => 'contact.contact.verify',
                'name'      => 'Verify Contact',
            ],
            [
                'slug'      => 'contact.contact.approve',
                'name'      => 'Approve Contact',
            ],
            [
                'slug'      => 'contact.contact.publish',
                'name'      => 'Publish Contact',
            ],
            [
                'slug'      => 'contact.contact.unpublish',
                'name'      => 'Unpublish Contact',
            ],
            [
                'slug'      => 'contact.contact.cancel',
                'name'      => 'Cancel Contact',
            ],
            [
                'slug'      => 'contact.contact.archive',
                'name'      => 'Archive Contact',
            ],
            */
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
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/contact/contact',
                'name'        => 'Contact',
                'description' => null,
                'icon'        => 'icon-book-open',
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

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
            [
                'key'      => 'contact.contact.key',
                'name'     => 'Some name',
                'value'    => 'Some value',
                'type'     => 'Default',
            ],
            */
        ]);
    }
}
