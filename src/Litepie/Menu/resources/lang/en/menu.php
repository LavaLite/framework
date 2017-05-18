<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for Menus Module
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default for menus module,
    | and it is used by the /view files in this module
    |
     */
    'name'        => 'Menu',
    'names'       => 'Menus',
    'subname'     => 'Sub Menu',

    'options'     => [
        'status' => [
            '1' => 'Show',
            '0' => 'Hide',
        ],
        'target' => [
            '_self'  => 'Same window',
            '_blank' => 'New window',
        ],

    ],
    'placeholder' => [
        'parent'      => 'Enter Parent',
        'uname'       => 'Enter Uname',
        'url'         => 'Enter url',
        'status'      => 'Enter Status',
        'role'        => 'Enter role required to access the menu',
        'order'       => 'Enter Order',
        'target'      => 'Select open in',
        'name'        => 'Enter Name',
        'description' => 'Enter Description',
        'key'         => 'Enter Key',
        'icon'        => 'Enter Icon Class',
    ],
    'label'       => [
        'parent_id'   => 'Parent',
        'uname'       => 'Uname',
        'url'         => 'Url',
        'status'      => 'Status',
        'role'        => 'Select role',
        'order'       => 'Menu Order',
        'target'      => 'Open in',
        'name'        => 'Name',
        'description' => 'Description',
        'key'         => 'Key',
        'has_sub'     => 'Has Sub',
        'icon'        => 'Icon',
        'submenu'     => 'Sub menu',
    ],
];
