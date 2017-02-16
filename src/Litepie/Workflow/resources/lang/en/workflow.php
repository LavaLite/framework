<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'          => 'Workflow',
    'names'         => 'Workflows',
    'title'       => [
        'user'  => 'My Workflows',
        'admin' => 'Workflows',
        'sub'   => [
            'user'  => 'Workflows created by me',
            'admin' => 'Workflows',
        ],
    ],

    /**
     * Options for select/radio/check.
     */
    'options'       => [
            'status'              => ['pending','completed','cancelled'],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'workflowable_id'            => 'Please enter workflowable_id',
        'workflowable_type'          => 'Please enter workflowable_type',
        'action'                     => 'Please enter action',
        'status'                     => 'Please enter status',
        'comment'                    => 'Please enter comment',
        'data'                       => 'Please enter data',
        'performable_id'              => 'Please enter performable_id',
        'performable_type'            => 'Please enter performable_type',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'workflowable_id'            => 'Workflowable id',
        'workflowable_type'          => 'Workflowable type',
        'action'                     => 'Action',
        'status'                     => 'Status',
        'comment'                    => 'Content',
        'data'                       => 'Data',
        'performable_id'              => 'Perfomable id',
        'performable_type'            => 'Perfomable type',
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
