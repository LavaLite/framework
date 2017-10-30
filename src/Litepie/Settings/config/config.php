<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'settings',

    /*
     * Modules.
     */
    'modules'   => ['setting'],

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

    
    'setting'       => [
        'model'             => 'Litepie\Settings\Models\Setting',
        'table'             => 'settings',
        'presenter'         => \Litepie\Settings\Repositories\Presenter\SettingItemPresenter::class,
        'hidden'            => [],
        'visible'           => [],
        'guarded'           => ['*'],
        'slugs'             => ['slug' => 'name'],
        'dates'             => ['deleted_at'],
        'appends'           => [],
        'fillable'          => ['user_id', 'key',  'package',  'module',  'name',  'value',  'file',  'control',  'type'],
        'translate'         => ['key',  'package',  'module',  'name',  'value',  'file',  'control',  'type'],
        'upload_folder'     => 'settings/setting',
        'uploads'           => [],
        'casts'             => [],
        'revision'          => [],
        'perPage'           => '20',
        'search'        => [
            'name'  => 'like',
            'status',
        ],

    ],
];
