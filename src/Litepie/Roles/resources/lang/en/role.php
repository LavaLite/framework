<?php

return [

    /*
     * Singlular and plural name of the module
     */
    'name'          => 'Role',
    'names'         => 'Roles',
    'title'         => [
        'user'  => 'My Roles',
        'admin' => 'Roles',
        'sub'   => [
            'user'  => 'Manage roles created by me',
            'admin' => 'Manage roles',
        ],
    ],

    /*
     * Options for select/radio/check.
     */
    'options'       => [

    ],

    /*
     * Placeholder for inputs
     */
    'placeholder'   => [
        'id'                         => 'Please enter id',
        'name'                       => 'Please enter name',
        'slug'                       => 'Please enter slug',
        'description'                => 'Please enter description',
        'level'                      => 'Please enter level',
        'created_at'                 => 'Please select created at',
        'updated_at'                 => 'Please select updated at',
    ],

    /*
     * Labels for inputs.
     */
    'label'         => [
        'id'                         => 'Id',
        'name'                       => 'Name',
        'slug'                       => 'Slug',
        'description'                => 'Description',
        'level'                      => 'Level',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    /*
     * Columns array for show hide checkbox.
     */
    'cloumns'         => [
        'name'                       => ['name' => 'Name', 'data-column' => 1, 'checked'],
        'slug'                       => ['name' => 'Slug', 'data-column' => 2, 'checked'],
        'level'                      => ['name' => 'Level', 'data-column' => 3, 'checked'],
    ],

    /*
     * Tab labels
     */
    'tab'           => [
        'name'  => 'Roles',
    ],

    /*
     * Texts  for the module
     */
    'text'          => [
        'preview' => 'Click on the below list for preview',
    ],
];
