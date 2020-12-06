<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for master in master package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  master module in master package
    | and it is used by the template/view files in this module
    |
     */

    /**
     * Singlular and plural name of the module.
     */
    'name'  => 'Master',
    'names' => 'Masters',

    /**
     * Singlular and plural name of the module.
     */
    'title' => [
        'main'   => 'Masters',
        'sub'    => 'Masters',
        'list'   => 'List of masters',
        'edit'   => 'Edit master',
        'create' => 'Create new master',
    ],

    /**
     * Options for select/radio/check.
     */
    'options' => [
        'status' => [
            'Show' => 'Show',
            'Hide' => 'Hide',
        ],
    ],

    /**
     * List of masters used in the project.
     */
    'masters' => [
        'single'   => 'Single',
        'category' => 'Category Style',
        'image'    => 'With Image',
        'icon'     => 'With Icon',
        'country'  => 'country',
        'state'    => 'State',
        'city'     => 'City',
        'location' => 'Location',
        'project'  => 'Project',
    ],

    /**
     * Groups of masters.
     */
    'groups' => [
        'master' => [
            'name'  => 'Master',
            'title' => 'List of masters',
        ],
        'project' => [
            'name'  => 'Projects',
            'title' => 'Project masters',
        ],
    ],

    /**
     * Placeholder for inputs.
     */
    'placeholder' => [
        'id'          => 'Please enter id',
        'parent_id'   => 'Please select parent',
        'type'        => 'Please select type',
        'name'        => 'Please enter name',
        'description' => 'Please enter description',
        'icon'        => 'Please enter icon',
        'amount'      => 'Please enter amount',
        'status'      => 'Please enter status',
        'image'       => 'Please enter image',
        'slug'        => 'Please enter slug',
        'created_at'  => 'Please select created at',
        'updated_at'  => 'Please select updated at',
        'deleted_at'  => 'Please select deleted at',
    ],

    /**
     * Labels for inputs.
     */
    'label' => [
        'id'          => 'Id',
        'parent_id'   => 'Parent',
        'type'        => 'Type',
        'name'        => 'Name',
        'description' => 'Description',
        'icon'        => 'Icon',
        'amount'      => 'Amount',
        'status'      => 'Status',
        'image'       => 'Image',
        'slug'        => 'Slug',
        'created_at'  => 'Created at',
        'updated_at'  => 'Updated at',
        'deleted_at'  => 'Deleted at',
    ],

    /**
     * Columns array for show hide checkbox.
     */
    'cloumns' => [
        'parent_id' => ['name' => 'Parent', 'data-column' => 1, 'checked'],
        'type'      => ['name' => 'Type', 'data-column' => 2, 'checked'],
        'name'      => ['name' => 'Name', 'data-column' => 3, 'checked'],
        'image'     => ['name' => 'Image', 'data-column' => 4, 'checked'],
    ],

    /**
     * Tab labels.
     */
    'tab' => [
        'name' => 'Masters',
    ],

    /**
     * Texts  for the module.
     */
    'text' => [
        'preview' => 'Click on the below list for preview',
    ],
];
