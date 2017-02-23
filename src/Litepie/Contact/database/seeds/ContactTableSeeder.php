<?php

use Illuminate\Database\Seeder;

class ContactTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'name'       => 'Renfos Technologies Pvt. Ltd.',
                'slug'       => 'renfos-technologies',
                'address'    => "INFOPARK TBC, \n JNI Stadium Complex",
                'street'     => 'Kaloor',
                'city'       => 'Kochi',
                'state'      => 'Kerala',
                'country'    => 'India',
                'zip'        => '682017',
                'phone'      => '+91 484-4011 609',
                'mobile'     => '+91 97444 89361',
                'email'      => 'india@renfos.com',
                'website'    => 'http://renfos.com',
                'details'    => "INFOPARK TBC  \n JNI Stadium Complex, Kaloor \n Kochi, Kerala, \n India, Pin - 682017",
                'created_at' => '2016-07-19 17:18:55',
                'updated_at' => '2016-07-19 11:48:55',
                'deleted_at' => null,
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
                'parent_id'   => 4,
                'key'         => null,
                'url'         => 'contact.htm',
                'name'        => 'Contact',
                'description' => null,
                'icon'        => null,
                'target'      => null,
                'order'       => 190,
                'status'      => 1,
            ],
            [
                'parent_id'   => 5,
                'key'         => null,
                'url'         => 'contact.htm',
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
