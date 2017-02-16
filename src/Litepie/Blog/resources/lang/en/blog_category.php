<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'          => 'Category',
    'names'         => 'Categories',
    'title'       => [
        'user'  => 'My Categories',
        'admin' => 'Categories',
        'sub'   => [
            'user'  => 'Categories created by me',
            'admin' => 'Categories',
        ],
    ],

    /**
     * Options for select/radio/check.
     */
    'options'       => [
        'status' => ['hide' => 'Hide', 'show' => 'Show'],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'name'                       => 'Please enter name',
        'status'                     => 'Please enter status',
        'user_type'                  => 'Please enter user_type',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'name'                       => 'Name',
        'status'                     => 'Status',
        'user_type'                  => 'User type',
        'status'                     => 'Status',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    /**
     * Tab labels
     */
    'tab'           => [
        'name'  => 'Name',
    ],

    /**
     * Texts  for the module
     */
    'text'          => [
        'preview' => 'Click on the below list for preview',
    ],
];
