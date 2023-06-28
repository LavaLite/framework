<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for role in role package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  role module in role package
    | and it is used by the template/view files in this module
    |
    */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Role',
    'names' => 'Roles',
    'icon' => 'las la-list',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Roles',
        'sub' => 'Roles'
    ],

    /**
     * Singlular and plural name of the module
     */
    'groups'         => [
        'main' => 'Main',
        'images' => 'Images',
        'details' => 'Details',
        'settings' => 'Settings'
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
    'options'       => [
        'level' => 
            [
                                
                [
                    'key'    => 11,
                    'value'  => 11,
                    'text'   => 11,
                ],
                                
            ],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'id'                         => 'Please enter id',
        'name'                       => 'Please enter name',
        'slug'                       => 'Please enter slug',
        'description'                => 'Please enter description',
        'level'                      => 'Please enter level',
        'deleted_at'                 => 'Please select deleted at',
        'created_at'                 => 'Please select created at',
        'updated_at'                 => 'Please select updated at',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'id'                         => 'Id',
        'name'                       => 'Name',
        'slug'                       => 'Slug',
        'description'                => 'Description',
        'level'                      => 'Level',
        'deleted_at'                 => 'Deleted at',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    
    ];
