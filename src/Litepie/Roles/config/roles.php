<?php

return [

    /**
     * Provider.
     */
    'provider'   => 'litepie',

    /*
     * Package.
     */
    'package'    => 'user',

    /*
     * Modules.
     */
    'modules'    => ['user', 'permission', 'role', 'team'],

    'image'      => [

        'sm'     => [
            'width'     => '140',
            'height'    => '140',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'md'     => [
            'width'     => '370',
            'height'    => '420',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'lg'     => [
            'width'     => '780',
            'height'    => '497',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'xl'     => [
            'width'     => '800',
            'height'    => '530',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'avatar' => [
            'male'   => '',
            'female' => '',
        ],
    ],


    'permission' => [
        'model'         => Litepie\User\Models\Permission::class,
        'table'         => 'permissions',
        'presenter'     => \Litepie\User\Repositories\Presenter\PermissionItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['slug', 'name'],
        'translate'     => [],
        'upload-folder' => 'user/permission',
        'uploads'       => [],
        'casts'         => [],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',
            'status',
        ],
    ],

    'role'       => [
        'model'         => \Litepie\User\Models\Role::class,
        'table'         => 'roles',
        'presenter'     => \Litepie\User\Repositories\Presenter\RoleItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => [],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['key', 'name', 'permissions'],
        'translate'     => [],

        'upload-folder' => 'user/role',
        'uploads'       => [],
        'casts'         => [
            'permissions' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name'       => 'like',
            'key'        => 'like',
            'created_at' => 'like',
            'updated_at' => 'like',
        ],

    ],
];