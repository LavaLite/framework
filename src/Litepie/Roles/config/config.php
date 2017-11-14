<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'roles',

    /*
     * Modules.
     */
    'modules'   => ['role', 
'permission'],

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

    'role'       => [
        'model' => [
            'model'                 => \Litepie\Roles\Models\Role::class,
            'table'                 => 'roles',
            'presenter'             => \Litepie\Roles\Repositories\Presenter\RoleItemPresenter::class,
            'hidden'                => [],
            'visible'               => [],
            'guarded'               => ['*'],
            'slugs'                 => ['slug' => 'name'],
            'dates'                 => ['deleted_at'],
            'appends'               => [],
            'fillable'              => ['user_id', 'id',  'name',  'slug',  'description',  'level',  'created_at',  'updated_at'],
            'translatables'         => [],
            'upload_folder'         => 'roles/role',
            'uploads'               => [],
            'casts'                 => [],
            'revision'              => [],
            'perPage'               => '20',
            'search'        => [
                'name'  => 'like',
                'status',
            ]
        ],

        'controller' => [
            'provider'  => 'Litepie',
            'package'   => 'Roles',
            'module'    => 'Role',
        ],

    ],

    'permission'       => [
        'model' => [
            'model'                 => \Litepie\Roles\Models\Permission::class,
            'table'                 => 'permissions',
            'presenter'             => \Litepie\Roles\Repositories\Presenter\PermissionItemPresenter::class,
            'hidden'                => [],
            'visible'               => [],
            'guarded'               => ['*'],
            'slugs'                 => ['slug' => 'name'],
            'dates'                 => ['deleted_at'],
            'appends'               => [],
            'fillable'              => ['user_id', 'id',  'name',  'slug',  'description',  'created_at',  'updated_at'],
            'translatables'         => [],
            'upload_folder'         => 'roles/permission',
            'uploads'               => [],
            'casts'                 => [],
            'revision'              => [],
            'perPage'               => '20',
            'search'        => [
                'name'  => 'like',
                'status',
            ]
        ],

        'controller' => [
            'provider'  => 'Litepie',
            'package'   => 'Roles',
            'module'    => 'Permission',
        ],

    ],
];
