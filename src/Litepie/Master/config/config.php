<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package'  => 'master',

    /*
     * Modules.
     */
    'modules'  => ['master'],

    /**
     * Type of masters used in the project
     */
    'masters'  => [
        'single' => [
            'view' => 'default',
        ],
        'tree'   => [
            'view' => 'tree',
        ],
        'image'  => [
            'view' => 'image',
        ],
        'icon'   => [
            'view' => 'icon',
        ],
    ],

    'master'   => [
        'model'      => [
            'model'         => \Litepie\Master\Models\Master::class,
            'table'         => 'masters',
            'presenter'     => \Litepie\Master\Repositories\Presenter\MasterPresenter::class,
            'hidden'        => [],
            'visible'       => [],
            'guarded'       => ['*'],
            'slugs'         => ['slug' => 'name'],
            'dates'         => ['deleted_at', 'createdat', 'updated_at'],
            'appends'       => [],
            'fillable'      => ['id', 'parent_id', 'type', 'name', 'description', 'icon', 'image', 'slug', 'created_at', 'updated_at', 'deleted_at'],
            'translatables' => [],
            'upload_folder' => 'master/master',
            'uploads'       => [

                'images' => [
                    'count' => 10,
                    'type'  => 'image',
                ],
                'file'   => [
                    'count' => 1,
                    'type'  => 'file',
                ],

            ],

            'casts'         => [
                /*
            'images'    => 'array',
            'file'      => 'array',
             */
            ],

            'revision'      => [],
            'perPage'       => '20',
            'search'        => [
                'name' => 'like',
                'status',
            ],
        ],

        'controller' => [
            'provider' => 'Litepie',
            'package'  => 'Master',
            'module'   => 'Master',
        ],

    ],
];
