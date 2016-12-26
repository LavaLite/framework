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

    'user'       => [
        'model'         => 'App\\User',
        'table'         => 'users',
        'presenter'     => \Litepie\User\Repositories\Presenter\UserItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => [],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'name', 'email', 'parent_id', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'designation', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'permissions'],
        'translate'     => ['name', 'email', 'parent_id', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'designation', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'permissions'],

        'upload_folder' => 'user/user',
        'uploads'       => [
            'single'   => ['photo'],
            'multiple' => [],
        ],
        'casts'         => [
            'permissions' => 'array',
            'photo' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [            
            'name' => 'like',
            'email' => 'like',
            'sex' => 'like',
            'dob' => 'like',
            'designation' => 'like',
            'mobile' => 'like',
            'street' => 'like',
            'status' => 'like',
            'created_at' => 'like',
            'updated_at' => 'like',
        ],
    
        'workflow'      => [
            'points' => [
                'start' => 'new',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'new'     => [
                    'label'  => "User created",
                    'action' => ['setStatus', 'new'],
                    'next'   => ['active', 'suspend', 'delete'],
                ],
                'active'  => [
                    'label'  => "User Activated",
                    'status' => ['setStatus', 'active'],
                    'next'   => ['suspend', 'delete'],
                ],
                'suspend' => [
                    'label'  => "User suspended",
                    'action' => ['setStatus', 'suspend'],
                    'next'   => ['active', 'delete'],
                ],
                'delete'  => [
                    'label'  => "User deleted",
                    'action' => ['delete'],
                ],
            ],
        ],
    ],

    'client'       => [
        'model'         => 'App\\Client',
        'table'         => 'clients',
        'presenter'     => \Litepie\User\Repositories\Presenter\UserItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => [],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'name', 'email', 'parent_id', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'designation', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'permissions'],
        'translate'     => ['name', 'email', 'parent_id', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'designation', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'permissions'],

        'upload_folder' => 'client/client',
        'uploads'       => [
            'single'   => ['photo'],
            'multiple' => [],
        ],
        'casts'         => [
            'permissions' => 'array',
            'photo' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [            
            'name' => 'like',
            'email' => 'like',
            'sex' => 'like',
            'dob' => 'like',
            'designation' => 'like',
            'mobile' => 'like',
            'street' => 'like',
            'status' => 'like',
            'created_at' => 'like',
            'updated_at' => 'like',
        ],
        
        'workflow'      => [
            'points' => [
                'start' => 'new',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'new'     => [
                    'label'  => "User created",
                    'action' => ['setStatus', 'new'],
                    'next'   => ['active', 'suspend', 'delete'],
                ],
                'active'  => [
                    'label'  => "User Activated",
                    'status' => ['setStatus', 'active'],
                    'next'   => ['suspend', 'delete'],
                ],
                'suspend' => [
                    'label'  => "User suspended",
                    'action' => ['setStatus', 'suspend'],
                    'next'   => ['active', 'delete'],
                ],
                'delete'  => [
                    'label'  => "User deleted",
                    'action' => ['delete'],
                ],
            ],
        ],
    ],

    'permission' => [
        'model'         => 'Litepie\User\Models\Permission',
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
        'uploads'       => [
            'single'   => [],
            'multiple' => [],
        ],
        'casts'         => [
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',
            'status',
        ],

    ],
    'role'       => [
        'model'         => 'Litepie\User\Models\Role',
        'table'         => 'roles',
        'presenter'     => \Litepie\User\Repositories\Presenter\RoleItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => [],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['key', 'name', 'permissions'],
        'translate'     => ['key', 'name', 'permissions'],

        'upload-folder' => 'user/role',
        'uploads'       => [
            'single'   => [],
            'multiple' => [],
        ],
        'casts'         => [
            'permissions' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',            
            'key' => 'like',
            'created_at' => 'like',
            'updated_at' => 'like',
        ],

    ],
    'team'       => [
        'model'         => 'Litepie\User\Models\Team',
        'table'         => 'teams',
        'presenter'     => \Litepie\User\Repositories\Presenter\TeamItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'name', 'description', 'settings'],
        'translate'     => ['name', 'description', 'settings'],

        'upload-folder' => 'user/team',
        'uploads'       => [
            'single'   => [],
            'multiple' => [],
        ],
        'casts'         => [
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',
            'description' => 'like',
            'status' => 'like',
            'created_at' => 'like',
            'updated_at' => 'like',
        ],

    ],
];
