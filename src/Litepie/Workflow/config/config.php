<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'workflow',

    /*
     * Modules.
     */
    'modules'   => ['workflow'],

    'image'    => [

        'sm' => [
            'width'     => '140',
            'height'    => '140',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'md' => [
            'width'     => '370',
            'height'    => '420',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'lg' => [
            'width'     => '780',
            'height'    => '497',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'xl' => [
            'width'     => '800',
            'height'    => '530',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

    ],

    'workflow'       => [
        'model'             => 'Litepie\Workflow\Models\Workflow',
        'table'             => 'workflows',
        'presenter'         => \Litepie\Workflow\Repositories\Presenter\WorkflowItemPresenter::class,
        'hidden'            => [],
        'visible'           => [],
        'guarded'           => ['*'],
        'slugs'             => [],
        'dates'             => ['deleted_at'],
        'appends'           => [],
        'fillable'          => ['id', 'user_id', 'workflowable_id',  'workflowable_type',  'action',  'status',  'data',  'performable_id',  'performable_type','guard'],
        'translate'         => ['workflowable_id',  'workflowable_type',  'action',  'status',  'data',  'performable_id',  'performable_type'],

        'upload_folder'     => 'workflow/workflow',
        'uploads'           => [
                                    'single'    => [],
                                    'multiple'  => [],
                               ],
        'casts'             => [
                                    'data' => 'array'
                               ],
        'revision'          => [],
        'perPage'           => '20',
        'search'        => [
            'name'  => 'like',
            'action'  => 'like',
            'workflowable_type' => 'like',
            'status',
            'created_at',
        ],

    ],
];
