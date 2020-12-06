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
    'modules' => ['user', 'client'],

    /*
     * Additional user types other than user.
     */
    'types' => ['client'],

    'user' => [
        'model' => [
            'model'     => \App\Models\User::class,
            'table'     => 'users',
            'presenter' => \Litepie\User\Repositories\Presenter\UserPresenter::class,
            'hidden'    => ['status', 'email_verified_at', 'user_id', 'user_type', 'created_at', 'updated_at', 'password', 'deleted_at', 'remember_token', 'upload_folder', 'id'],
            'visible'   => [],
            'guarded'   => ['*'],
            'slugs'     => [],
            'dates'     => ['created_at', 'updated_at', 'deleted_at', 'dob'],
            'appends'   => ['picture'],
            'fillable'  => ['user_id', 'name', 'email', 'parent_id', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'designation', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'permissions'],
            'translate' => [],

            'upload_folder' => 'user/user',
            'uploads'       => [
                'photo' => [
                    'count' => 1,
                    'type'  => 'image',
                ],
            ],
            'casts' => [
                'permissions' => 'array',
                'photo'       => 'array',
                'dob'         => 'date',
            ],
            'revision' => [],
            'perPage'  => '20',
            'search'   => [
                'name'        => 'like',
                'email'       => 'like',
                'sex'         => 'like',
                'dob'         => 'like',
                'designation' => 'like',
                'mobile'      => 'like',
                'street'      => 'like',
                'status'      => 'like',
                'created_at'  => 'like',
                'updated_at'  => 'like',
            ],
        ],

    ],

    'client' => [
        'model' => [
            'model'         => \App\Models\Client::class,
            'table'         => 'clients',
            'presenter'     => \Litepie\User\Repositories\Presenter\ClientPresenter::class,
            'hidden'        => ['status', 'email_verified_at', 'user_id', 'user_type', 'created_at', 'updated_at', 'password', 'deleted_at', 'remember_token', 'upload_folder', 'id'],
            'visible'       => [],
            'guarded'       => ['*'],
            'slugs'         => ['slug' => 'name'],
            'dates'         => ['deleted_at', 'created_at', 'updated_at', 'dob'],
            'appends'       => ['picture'],
            'fillable'      => ['id', 'name', 'email', 'password', 'api_token', 'remember_token', 'sex', 'dob', 'mobile', 'phone', 'address', 'street', 'city', 'district', 'state', 'country', 'photo', 'web', 'status', 'upload_folder', 'deleted_at', 'created_at', 'updated_at'],
            'translatables' => [],
            'upload_folder' => 'user/client',
            'uploads'       => [
                'photo' => [
                    'count' => 1,
                    'type'  => 'image',
                ],
            ],
            'casts' => [
                'photo' => 'array',
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
            'package'  => 'Clients',
            'module'   => 'Client',
        ],

    ],
];
