<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'name'      => 'Renfos Technologies Pvt. Ltd.',
                'phone'     => '+91 484 4011 609',
                'mobile'    => '+91 484 4011 609',
                'email'     => 'india@renfos.com',
                'website'   => 'http://www.renfos.com',
                'address'   => "INFOPARK TBC \n JNI Stadium Complex \n Kochi, Kerala \n India - 682017",
                'slug'      => 'renfos-technologies',
                'status'    => 'publish',
                'user_type' => 'App\\User',
                'user_id'   => '1',
            ],
        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/contact/contact',
                'name'        => 'Contact Us',
                'description' => null,
                'icon'        => 'fa fa-phone-square',
                'target'      => null,
                'order'       => 140,
                'status'      => 1,
            ],
            [
                'parent_id'   => 4,
                'key'         => null,
                'url'         => 'contact.htm',
                'name'        => 'Contact Us',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 140,
                'status'      => 1,
            ],

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
