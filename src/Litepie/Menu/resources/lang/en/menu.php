<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for menu in menu package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  menu module in menu package
    | and it is used by the template/view files in this module
    |
    */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Menu',
    'names' => 'Menus',
    'icon' => 'las la-list',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Menus',
        'sub' => 'Menus'
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
        'target' => 
            [
                                
                [
                    'key'    => '_blank',
                    'value'  => '_blank',
                    'text'   => '_blank',
                ],
                                
                [
                    'key'    => '_self',
                    'value'  => '_self',
                    'text'   => '_self',
                ],
                                
            ],

        'status' => 
            [
                                
                [
                    'key'    => 'Show',
                    'value'  => 'Show',
                    'text'   => 'Show',
                ],
                                
                [
                    'key'    => 'Hide',
                    'value'  => 'Hide',
                    'text'   => 'Hide',
                ],
                                
            ],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'id'                         => 'Please enter id',
        'parent_id'                  => 'Please enter parent id',
        'key'                        => 'Please enter key',
        'url'                        => 'Please enter url',
        'icon'                       => 'Please enter icon',
        'permission'                 => 'Please enter permission',
        'role'                       => 'Please enter role',
        'name'                       => 'Please enter name',
        'description'                => 'Please enter description',
        'target'                     => 'Please select target',
        'order'                      => 'Please enter order',
        'uload_folder'               => 'Please enter uload folder',
        'slug'                       => 'Please enter slug',
        'status'                     => 'Please select status',
        'upload_folder'              => 'Please enter upload folder',
        'deleted_at'                 => 'Please select deleted at',
        'created_at'                 => 'Please select created at',
        'updated_at'                 => 'Please select updated at',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'id'                         => 'Id',
        'parent_id'                  => 'Parent id',
        'key'                        => 'Key',
        'url'                        => 'Url',
        'icon'                       => 'Icon',
        'permission'                 => 'Permission',
        'role'                       => 'Role',
        'name'                       => 'Name',
        'description'                => 'Description',
        'target'                     => 'Target',
        'order'                      => 'Order',
        'uload_folder'               => 'Uload folder',
        'slug'                       => 'Slug',
        'status'                     => 'Status',
        'upload_folder'              => 'Upload folder',
        'deleted_at'                 => 'Deleted at',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    
    ];
