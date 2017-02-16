<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'        => 'Revision',
    'names'       => 'Revisions',
    'user_name'   => 'My <span>Revision</span>',
    'user_names'  => 'My <span>Revision</span>',
    'create'      => 'Create My Revision',
    'edit'        => 'Update My Revision',

    /**
     * Options for select/radio/check.
     */
    'options'       => [
            'status'=>[   
                'approve' => 'Approve',
                'archive' => 'Archive'  ,           
                'complete' => 'Complete',
                'draft' =>'Draft',                          
                'publish' => 'Publish',
                'unpublish' => 'Unpublish',
                'verify' =>'Verify',      
                 ]
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'title'                      => 'Please enter title',
        'status'                      => 'Please enter status',
        'description'                => 'Please enter description',
        'images'                     => 'Please enter images',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'title'                      => 'Title',
        'status'                     => 'Status',
        'description'                => 'Description',
        'images'                     => 'Images',
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
