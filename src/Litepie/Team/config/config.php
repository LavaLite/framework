<?php

return [

    /*
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package' => 'user',

    /*
     * Modules.
     */
    'modules' => ['team'],

    'team' => [
        'model' => [
            'model'         => \Litepie\Team\Models\Team::class,
            'table'         => 'teams',
            'presenter'     => \Litepie\Team\Repositories\Presenter\TeamPresenter::class,
            'hidden'        => [],
            'visible'       => [],
            'guarded'       => ['*'],
            'slugs'         => ['slug' => 'name'],
            'dates'         => ['deleted_at', 'createdat', 'updated_at'],
            'appends'       => [],
            'fillable'      => ['name'],
            'translatables' => [],
            'upload_folder' => 'user/team',
            'uploads'       => [
                /*
            'images' => [
            'count' => 10,
            'type'  => 'image',
            ],
            'file' => [
            'count' => 1,
            'type'  => 'file',
            ],
             */
            ],

            'casts' => [
                /*
            'images'    => 'array',
            'file'      => 'array',
             */
            ],

            'revision' => [],
            'perPage'  => '20',
            'search'   => [
                'name' => 'like',
                'status',
            ],
        ],
    ],
];
