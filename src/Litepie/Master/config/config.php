<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package' => 'master',

    /*
     * Modules.
     */
    'modules' => ['master'],

    /**
     * Type of masters used in the project.
     */
    'masters' => [
        'single' => [
            'group'  => 'master',
            'type'   => 'single',
            'fields' => [],
        ],
        'category' => [
            'group'  => 'master',
            'type'   => 'category',
            'fields' => ['parent_id'],
        ],
        'image' => [
            'group'  => 'master',
            'type'   => 'image',
            'fields' => ['image'],
        ],
        'icon' => [
            'group'  => 'master',
            'type'   => 'icon',
            'fields' => ['icon'],
        ],
        'project' => [
            'view'  => 'project.default',
            'type'  => 'project',
            'group' => 'project',
        ],
    ],

    'master' => [
        'model' => [
            'model'     => \Litepie\Master\Models\Master::class,
            'table'     => 'masters',
            'presenter' => \Litepie\Master\Repositories\Presenter\MasterPresenter::class,
            'hidden'    => [],
            'visible'   => [],
            'guarded'   => ['*'],
            'slugs'     => ['slug' => 'name'],
            'dates'     => ['deleted_at', 'createdat', 'updated_at'],
            'appends'   => [],
            'fillable'  => ['id', 'parent_id', 'type', 'name', 'code', 'amount', 'abbr',
                'description', 'icon', 'image', 'images', 'files', 'extras',
                'slug', 'order', 'status', 'created_at', 'updated_at', 'deleted_at', ],
            'translatables' => [],
            'upload_folder' => 'master/master',
            'uploads'       => [
                'image' => [
                    'count' => 1,
                    'type'  => 'image',
                ],
                'images' => [
                    'count' => 10,
                    'type'  => 'image',
                ],
                'file' => [
                    'count' => 10,
                    'type'  => 'file',
                ],
            ],
            'casts' => [
                'image'  => 'array',
                'images' => 'array',
                'file'   => 'array',
                'extras' => 'array',
            ],
            'revision' => [],
            'perPage'  => '20',
            'search'   => [
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
