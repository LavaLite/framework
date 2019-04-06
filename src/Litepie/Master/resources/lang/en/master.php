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
     * Singlular and plural name of the module
     */
    'name'        => 'Master',
    'names'       => 'Masters',

    /**
     * Singlular and plural name of the module
     */
    'title'       => [
        'main'   => 'Masters',
        'sub'    => 'Masters',
        'list'   => 'List of masters',
        'edit'   => 'Edit master',
        'create' => 'Create new master',
    ],

    /**
     * Options for select/radio/check.
     */
    'options'     => [
        'type' => ['mothertongue' => 'mothertongue', 'religion' => 'religion', 'caste' => 'caste', 'subcaste' => 'subcaste', 'height' => 'height', 'education' => 'education', 'occupation' => 'occupation', 'star' => 'star', 'raasi' => 'raasi', 'subscription' => 'subscription', 'nationality' => 'nationality', 'bloodgroup' => 'bloodgroup', 'hobbies' => 'hobbies'],

    ],

    /**
     * List of masters used in the project
     */

    'masters'     => [
        'single' => 'Single',
        'tree'   => 'Tree Style',
        'image'  => 'With Image',
        'icon'   => 'With Icon',
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'id'              => 'Please enter id',
        'parent_id'       => 'Please select parent',
        'type'            => 'Please select type',
        'name'            => 'Please enter name',
        'bloodgroup'      => 'Please enter bloodgroup',
        'height'          => 'Please enter height',
        'nationality'     => 'Please enter nationality',
        'mothertongue'    => 'Please enter mothertongue',
        'education_type'  => 'Please enter education_type',
        'education'       => 'Please enter education',
        'occupation_type' => 'Please enter occupation_type',
        'occupation'      => 'Please enter occupation',
        'religion'        => 'Please enter religion',
        'caste'           => 'Please enter caste',
        'raasi'           => 'Please enter raasi',
        'star'            => 'Please enter star',
        'hobbies'         => 'Please enter hobbies',
        'description'     => 'Please enter description',
        'icon'            => 'Please enter icon',
        'image'           => 'Please enter image',
        'slug'            => 'Please enter slug',
        'created_at'      => 'Please select created at',
        'updated_at'      => 'Please select updated at',
        'deleted_at'      => 'Please select deleted at',
    ],

    /**
     * Labels for inputs.
     */
    'label'       => [
        'id'          => 'Id',
        'parent_id'   => 'Parent',
        'type'        => 'Type',
        'name'        => 'Name',
        'description' => 'Description',
        'icon'        => 'Icon',
        'image'       => 'Image',
        'slug'        => 'Slug',
        'created_at'  => 'Created at',
        'updated_at'  => 'Updated at',
        'deleted_at'  => 'Deleted at',
    ],

    /**
     * Columns array for show hide checkbox.
     */
    'cloumns'     => [
        'parent_id' => ['name' => 'Parent', 'data-column' => 1, 'checked'],
        'type'      => ['name' => 'Type', 'data-column' => 2, 'checked'],
        'name'      => ['name' => 'Name', 'data-column' => 3, 'checked'],
        'image'     => ['name' => 'Image', 'data-column' => 4, 'checked'],
    ],

    /**
     * Tab labels
     */
    'tab'         => [
        'name' => 'Masters',
    ],

    /**
     * Texts  for the module
     */
    'text'        => [
        'preview' => 'Click on the below list for preview',
    ],
];
