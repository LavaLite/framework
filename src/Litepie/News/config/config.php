<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package'  => 'news',

    /*
     * Modules.
     */
    'modules'  => ['news'],

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

    'news'     => [
        'model'         => 'Litepie\News\Models\News',
        'table'         => 'news',
        'presenter'     => \Litepie\News\Repositories\Presenter\NewsItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'title', 'description', 'images'],
        'translate'     => ['title', 'description', 'images'],

        'upload_folder' => '/news/news',
        'uploads'       => [
            'single'   => ['image'],
            'multiple' => ['images'],
        ],
        'casts'         => [
            'image'  => 'array',
            'images' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'title' => 'like',
            'status',
        ],
        'workflow'      => [
            'points' => [
                'start' => 'draft',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'draft'     => [
                    'label'  => "News created",
                    'action' => ['setStatus', 'draft'],
                    'next'   => [
                        'complete' => [
                            'target' => 'complete',
                        ],
                    ],
                ],
                'complete'  => [
                    'label'  => "News completed",
                    'status' => ['setStatus', 'complete'],
                    'next'   => [
                        'verify' => [
                            'target' => 'verify',
                        ],
                    ],
                ],
                'verify'    => [
                    'label'  => "News verified",
                    'status' => ['setStatus', 'verify'],
                    'next'   => [
                        'approve' => [
                            'target' => 'approve',
                        ],
                    ],
                ],
                'approve'   => [
                    'label'  => "News approved",
                    'status' => ['setStatus', 'approve'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                    ],
                ],
                'publish'   => [
                    'label'  => "News published",
                    'status' => ['setStatus', 'publish'],
                    'next'   => [
                        'unpublish' => [
                            'target' => 'unpublish',
                        ],
                        'delete'    => [
                            'target' => 'delete',
                        ],
                        'archive'   => [
                            'target' => 'archive',
                        ],
                    ],
                ],
                'unpublish' => [
                    'label'  => "News unpublished",
                    'status' => ['setStatus', 'unpublish'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'archive' => [
                            'target' => 'archive',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'archive'   => [
                    'label'  => "News archived",
                    'status' => ['setStatus', 'archive'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'delete'    => [
                    'Label'  => "News deleted",
                    'status' => ['delete', 'archive'],
                    'next'   => '~',
                ],
            ],
        ],
    ],
];
