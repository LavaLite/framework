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
        'members' => 'Members',
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
        'level' => [
            '1' => [
                'key' => '1',
                'value' => '1',
                'text' => '1 - Guest',
                'name' => '1 - Guest',
            ],

            '2' => [
                'key' => '2',
                'value' => '2',
                'text' => '2 - Admin',
                'name' => '2 - Admin',
            ],
            '3' => [
                'key' => '3',
                'value' => '3',
                'text' => '3 - Manager',
                'name' => '3 - Manager',
            ],
            '4' => [
                'key' => '4',
                'value' => '4',
                'text' => '4 - Administrator',
                'name' => '4 - Administrator',
            ],
            '5' => [
                'key' => '5',
                'value' => '5',
                'text' => '5 - Super User',
                'name' => '5 - Super User',
            ],
        ],
        'type' => [
            [
                'key' => 'Default',
                'value' => 'Default',
                'text' => 'Default',
            ],
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

        'status' => [
            [
                'key' => '',
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
