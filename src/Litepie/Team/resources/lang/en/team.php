<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for team in team package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  team module in team package
    | and it is used by the template/view files in this module
    |
     */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Team',
    'names' => 'Teams',
    'icon' => 'las la-list',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Teams',
        'sub' => 'Teams',
    ],

    /**
     * Singlular and plural name of the module
     */
    'groups' => [
        'main' => 'Main',
        'images' => 'Images',
        'details' => 'Details',
        'settings' => 'Settings',
        'team_users' => 'Team Users',
    ],

    /**
     * Form sub section name for the module.
     */
    'sections' => [
        'main' => 'Main',
        'details' => 'Details',
    ],

    /**
     * Options for select/radio/check.
     */
    'options' => [
        'level' =>
        [

            [
                'key' => '1',
                'value' => '1',
                'text' => '1',
                'name' => 'Guest',
            ],

            [
                'key' => '2',
                'value' => '2',
                'text' => '2',
                'name' => 'Admin',
            ],

            [
                'key' => '3',
                'value' => '3',
                'text' => '3',
                'name' => 'Manager',
            ],

            [
                'key' => '4',
                'value' => '4',
                'text' => '4',
                'name' => 'Administrator',
            ],
            [
                'key' => '5',
                'value' => '5',
                'text' => '5',
                'name' => 'Super User',
            ],

        ],
        'role' =>
        [

            [
                'key' => 'User',
                'value' => 'User',
                'text' => 'User',
            ],

            [
                'key' => 'Admin',
                'value' => 'Admin',
                'text' => 'Admin',
            ],

            [
                'key' => 'Manager',
                'value' => 'Manager',
                'text' => 'Manager',
            ],


        ],
        'type' =>
        [

            [
                'key' => 'Product',
                'value' => 'Product',
                'text' => 'Product',
            ],

            [
                'key' => 'Lead',
                'value' => 'Lead',
                'text' => 'Lead',
            ],

            [
                'key' => 'Oppertunity',
                'value' => 'Oppertunity',
                'text' => 'Oppertunity',
            ],

            [
                'key' => 'Deal',
                'value' => 'Deal',
                'text' => 'Deal',
            ],

        ],

        'status' =>
        [

            [
                'key' => 'Default',
                'value' => 'Default',
                'text' => 'Default',
            ],

            [
                'key' => 'Active',
                'value' => 'Active',
                'text' => 'Active',
            ],

            [
                'key' => 'Inactive',
                'value' => 'Inactive',
                'text' => 'Inactive',
            ],

        ],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'id' => 'Please enter id',
        'name' => 'Please enter name',
        'key' => 'Please enter key',
        'level' => 'Please select level',
        'type' => 'Please select type',
        'status' => 'Please select status',
        'description' => 'Please enter description',
        'user' => 'Please enter user',
        'role' => 'Please enter role',
        'level' => 'Please enter level',
        'settings' => 'Please enter settings',
        'deleted_at' => 'Please select deleted at',
        'created_at' => 'Please select created at',
        'updated_at' => 'Please select updated at',
    ],

    /**
     * Labels for inputs.
     */
    'label' => [
        'id' => 'Id',
        'name' => 'Name',
        'key' => 'Key',
        'level' => 'Level',
        'type' => 'Type',
        'status' => 'Status',
        'description' => 'Description',
        'user' => 'User',
        'role' => 'Role',
        'level' => 'Level',
        'settings' => 'Settings',
        'deleted_at' => 'Deleted at',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
    ],

];
