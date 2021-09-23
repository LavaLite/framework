<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'alerts',

    /*
     * Modules.
     */
    'modules'   => ['notification'],

    'image'    => [

        'sm' => [
            'width'     => '140',
            'height'    => '140',
            'alerts'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'md' => [
            'width'     => '370',
            'height'    => '420',
            'alerts'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'lg' => [
            'width'     => '780',
            'height'    => '497',
            'alerts'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'xl' => [
            'width'     => '800',
            'height'    => '530',
            'alerts'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

    ],

    'notification'       => [
        'model'             => 'Litepie\Notification\Models\Notification',
        'table'             => 'notifications',
        'presenter'         => \Litepie\Notification\Repositories\Presenter\NotificationItemPresenter::class,
        'hidden'            => [],
        'visible'           => [],
        'guarded'           => ['*'],
        'slugs'             => ['slug' => 'name'],
        'dates'             => ['deleted_at'],
        'appends'           => [],
        'fillable'          => ['user_id', 'type',  'notifiable_id',  'notifiable_type',  'data',  'read_at'],
        'translate'         => ['type',  'notifiable_id',  'notifiable_type',  'data',  'read_at'],

        'upload_folder'     => 'alerts/notification',
        'uploads'           => [
            'single'    => [],
            'multiple'  => [],
        ],
        'casts'             => [
        ],
        'revision'          => [],
        'perPage'           => '20',
        'search'            => [
            'name'  => 'like',
            'status',
        ],
        /*
        'workflow'      => [
            'points' => [
                'start' => 'draft',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'draft'     => [
                    'label'  => "Notification created",
                    'alerts' => ['setStatus', 'draft'],
                    'next'   => ['complete'],
                ],
                'complete'  => [
                    'label'  => "Notification completed",
                    'status' => ['setStatus', 'complete'],
                    'next'   => ['verify'],
                ],
                'verify'    => [
                    'label'  => "Notification verified",
                    'alerts' => ['setStatus', 'verify'],
                    'next'   => ['approve'],
                ],
                'approve'   => [
                    'label'  => "Notification approved",
                    'alerts' => ['setStatus', 'approve'],
                    'next'   => ['publish'],
                ],
                'publish'   => [
                    'label'  => "Notification published",
                    'alerts' => ['setStatus', 'publish'],
                    'next'   => ['unpublish', 'delete', 'target', 'archive'],
                ],
                'unpublish' => [
                    'label'  => "Notification unpublished",
                    'alerts' => ['setStatus', 'unpublish'],
                    'next'   => ['publish', 'target', 'archive', 'delete'],
                ],
                'archive'   => [
                    'label'  => "Notification archived",
                    'alerts' => ['setStatus', 'archive'],
                    'next'   => ['publish', 'delete'],
                ],
                'delete'    => [
                    'Label'  => "Notification deleted",
                    'status' => ['delete', 'archive'],
                ],
            ],
        ],
        */
    ],
];
