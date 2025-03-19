<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'user',

    /*
     * Modules.
     */
    'modules'   => ['user', 'client'],

    'client' =>     [
        'model' => [
            'model' => \Litepie\User\Models\Client::class,
            'table' => 'clients',
            'hidden' => [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'email',  'password',  'api_token',  'remember_token',  'sex',  'dob',  'designation',  'mobile',  'phone',  'address',  'street',  'city',  'Region',  'state',  'country',  'photo',  'web',  'status',  'email_verified_at',  'user_id',  'user_type'],
            'translatables' => [],
            'upload_folder' => 'user/client',
            'uploads' => [],

            'casts' => [],

            'revision' => [],
            'perPage' => '20',
            'search'        => [
                'name'  => 'like',
                'status',
            ],
            'log_action' => [
                'exclude' => ['updated_at'],
                'label' => 'user::user.label.',
            ],
            'log_activity' => [
                'exclude' => ['updated_at'],
                'casts' => [],
                'label' => 'user::user.label.',
                'fields' => []
            ],
        ],


        'search' => [],
        'list' => [
            [
                "key" => "name",
                "type" => "text",
                "label" => 'user::client.label.name',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "email",
                "type" => "text",
                "label" => 'user::client.label.email',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "sex",
                "type" => "text",
                "label" => 'user::client.label.sex',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "dob",
                "type" => "text",
                "label" => 'user::client.label.dob',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "designation",
                "type" => "text",
                "label" => 'user::client.label.designation',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "mobile",
                "type" => "text",
                "label" => 'user::client.label.mobile',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "phone",
                "type" => "text",
                "label" => 'user::client.label.phone',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "address",
                "type" => "text",
                "label" => 'user::client.label.address',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "street",
                "type" => "text",
                "label" => 'user::client.label.street',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "city",
                "type" => "text",
                "label" => 'user::client.label.city',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "state",
                "type" => "text",
                "label" => 'user::client.label.state',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "country",
                "type" => "text",
                "label" => 'user::client.label.country',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "photo",
                "type" => "text",
                "label" => 'user::client.label.photo',
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "web",
                "type" => "text",
                "label" => 'user::client.label.web',
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.name',
                "placeholder" => 'user::client.placeholder.name',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'email',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.email',
                "placeholder" => 'user::client.placeholder.email',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'sex',
                "element" => 'radios',
                "type" => 'radios',
                "label" => 'user::client.label.sex',
                "placeholder" => 'user::client.placeholder.sex',
                "rules" => '',
                "options" => function () {
                    return trans('user::client.options.sex');
                },
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'dob',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::client.label.dob',
                "placeholder" => 'user::client.placeholder.dob',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'designation',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.designation',
                "placeholder" => 'user::client.placeholder.designation',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'mobile',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.mobile',
                "placeholder" => 'user::client.placeholder.mobile',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'phone',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.phone',
                "placeholder" => 'user::client.placeholder.phone',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'address',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.address',
                "placeholder" => 'user::client.placeholder.address',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'street',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.street',
                "placeholder" => 'user::client.placeholder.street',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'city',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.city',
                "placeholder" => 'user::client.placeholder.city',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'state',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.state',
                "placeholder" => 'user::client.placeholder.state',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'country',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'user::client.label.country',
                "placeholder" => 'user::client.placeholder.country',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'photo',
                "element" => 'file',
                "type" => 'image',
                "label" => 'user::client.label.photo',
                "placeholder" => 'user::client.placeholder.photo',
                "rules" => '',
                "group" => "main.main",
                "col" => "12",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'web',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::client.label.web',
                "placeholder" => 'user::client.placeholder.web',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
        ],

        'urls' => [
            'new' => [
                'url' => 'user/client/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'user/client/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'user/client',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'user/client',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'user/client',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'user/client',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'user::client.label.created_at',
            'name' => 'user::client.label.name',
            'status' => 'user::client.label.status',
        ],
        'groups' => [
            [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "user::client.groups.main",
                'group' => "main.main",
                'title' => "user::client.groups.main",
            ],
            [
                'icon' => "fe:home",
                'name' => "user::client.groups.details",
                'group' => "main.details",
                'title' => "user::client.groups.details",
            ],
            [
                'icon' => "fe:home",
                'name' => "user::client.groups.images",
                'group' => "main.images",
                'title' => "user::client.groups.images",
            ],
            [
                'icon' => "fe:home",
                'name' => "user::client.groups.settings",
                'group' => "main.settings",
                'title' => "user::client.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'User',
            'module' => 'Client',
        ],



    ],
    'user' => [
        'model' => [
            'model' => \Litepie\User\Models\User::class,
            'table' => 'users',
            'hidden' => [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['team_id',  'reporting_to',  'name',  'email',  'password',  'api_token',  'remember_token',  'sex',  'dob',  'doj',  'designation',  'mobile',  'phone',  'address',  'street',  'city',  'region',  'state',  'country',  'photo',  'web',  'social_urls',  'status',  'email_verified_at',  'user_id',  'user_type', 'rera', 'education', 'languages'],
            'translatables' => [],
            'upload_folder' => 'user/user',
            'uploads' => [
                /*
                    'images' => [
                        'count' => 10,
                        'type'  => 'image',
                    ],
                    'file' => [
                        'count' => 1,
                        'type'  => 'file',
                    ],
            */],

            'casts' => [
                'phone' => 'array',
                'languages' => 'array',
                'photo' => 'array',
                /*
                'images'    => 'array',
                'file'      => 'array',
            */
            ],

            'revision' => [],
            'perPage' => '20',
            'search'        => [
                'name'  => 'like',
                'status' => '=',
                'user_type' => '='
            ],
            'log_activity' => [
                'exclude' => ['updated_at'],
                'casts' => [],
                'label' => 'user::user.label.',
                'fields' => []
            ],
            'log_action' => [
                'exclude' => ['updated_at'],
                'label' => 'user::user.label.',
            ],
        ],

        'search' => [
            [
                'key' => 'status',
                'label' => 'user::user.label.status',
                'type' => 'select',
                'position' => 'top_dropdown',
                'col' => '4',
                'placeholder' => '',
                'options' => function () {
                    return trans('user::user.options.status_all');
                },
                'icon' =>  'fa-solid:stream',
            ],
            [
                'key' => 'user_type',
                'label' => 'user::user.label.user_type',
                'type' => 'select',
                'position' => 'top_dropdown',
                'col' => '4',
                'placeholder' => '',
                'options' => function () {
                    return trans('user::user.options.user_type_all');
                },
                'icon' =>  'fa-solid:user-tag',
            ],
            [
                'key' => 'general_search',
                'label' => 'user::user.label.location',
                'type' => 'search',
                'icon' => 'fa6-solid:location-dot',
                'column' => '4',
                'placeholder' => '',
                'position' => 'general_search',
            ],
        ],

        'list' => [
            [
                'key' => 'property',
                'type' => 'property',
                'label' => 'Property',
                'sort' => true,
                'roles' => [],
                'sub_keys' => [
                    'ref' => 'ref',
                    'title' => 'title',
                    'location' => 'location',
                ],
                'thstyle' => [
                    'min-width' => '180px',
                    'max-width' => '180px'
                ],
            ],
            [
                "key" => "email",
                "type" => "text",
                "label" => 'user::user.label.email',
                'sort' => true,
                'minlength' => '23',
                'roles' => [],
                'thstyle' => [
                    'min-width' => '160px',
                    'max-width' => '160px'
                ],
            ],
            [
                "key" => "designation",
                "type" => "text",
                "label" => 'user::user.label.designation',
                'sort' => true,
                'roles' => [],
                'minlength' => '15',
                'thstyle' => [
                    'min-width' => '110px',
                    'max-width' => '110px'
                ],
            ],
            [
                "key" => "languages",
                "type" => "text",
                "label" => 'user::user.label.languages',
                'sort' => true,
                'roles' => [],
                'minlength' => '25',
                'thstyle' => [
                    'min-width' => '180px',
                    'max-width' => '180px'
                ],
            ],
            [
                "key" => "user_type",
                "type" => "text",
                "label" => 'user::user.label.type',
                'sort' => true,
                'roles' => [],
                'thstyle' => [
                    'min-width' => '100px',
                    'max-width' => '100px'
                ],
            ],
            [
                "key" => "doj",
                "type" => "text",
                "label" => 'user::user.label.doj',
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.name',
                "placeholder" => 'user::user.placeholder.name',
                "rules" => '',
                "group" => "main.details",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'email',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.email',
                "placeholder" => 'user::user.placeholder.email',
                "rules" => '',
                "group" => "main.details",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'password',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.password',
                "placeholder" => 'user::user.placeholder.password',
                "rules" => '',
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'sex',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.sex',
                "placeholder" => 'user::user.placeholder.sex',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.sex');
                },
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'status',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.status',
                "placeholder" => 'user::user.placeholder.status',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.status');
                },
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],

            [
                "key" => 'designation',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.designation',
                "placeholder" => 'user::user.placeholder.designation',
                "rules" => '',
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'user_type',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.user_type',
                "placeholder" => 'user::user.placeholder.user_type',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.user_type');
                },
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'doj',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::user.label.doj',
                "placeholder" => 'user::user.placeholder.doj',
                "rules" => '',
                "group" => "main.details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'team_id',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.team_id',
                "placeholder" => 'user::user.placeholder.team_id',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.team_id');
                },
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'reporting_to',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.reporting_to',
                "placeholder" => 'user::user.placeholder.reporting_to',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.reporting_to');
                },
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.name',
                "placeholder" => 'user::user.placeholder.name',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'email',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.email',
                "placeholder" => 'user::user.placeholder.email',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'sex',
                "element" => 'radios',
                "type" => 'radios',
                "label" => 'user::user.label.sex',
                "placeholder" => 'user::user.placeholder.sex',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.sex');
                },
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'dob',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::user.label.dob',
                "placeholder" => 'user::user.placeholder.dob',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'doj',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::user.label.doj',
                "placeholder" => 'user::user.placeholder.doj',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'designation',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.designation',
                "placeholder" => 'user::user.placeholder.designation',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'mobile',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.mobile',
                "placeholder" => 'user::user.placeholder.mobile',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'phone',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.phone',
                "placeholder" => 'user::user.placeholder.phone',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'address',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.address',
                "placeholder" => 'user::user.placeholder.address',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'street',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.street',
                "placeholder" => 'user::user.placeholder.street',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'city',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.city',
                "placeholder" => 'user::user.placeholder.city',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'state',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.state',
                "placeholder" => 'user::user.placeholder.state',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'country',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'user::user.label.country',
                "placeholder" => 'user::user.placeholder.country',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'photo',
                "element" => 'file',
                "type" => 'image',
                "label" => 'user::user.label.photo',
                "placeholder" => 'user::user.placeholder.photo',
                "rules" => '',
                "group" => "main.main",
                "col" => "12",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'web',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.web',
                "placeholder" => 'user::user.placeholder.web',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'social_urls',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.social_urls',
                "placeholder" => 'user::user.placeholder.social_urls',
                "rules" => '',
                "group" => "main.main",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],

            [
                "key" => 'email',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.email',
                "placeholder" => 'user::user.placeholder.email',
                "rules" => '',
                "group" => "main.user_login_details",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'password',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.password',
                "placeholder" => 'user::user.placeholder.password',
                "rules" => '',
                "group" => "main.user_login_details",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.name',
                "placeholder" => 'user::user.placeholder.name',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "6",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'sex',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.sex',
                "placeholder" => 'user::user.placeholder.sex',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.sex');
                },
                "group" => "main.user_details",
                "col" => "3",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'status',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.status',
                "placeholder" => 'user::user.placeholder.status',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.status');
                },
                "group" => "main.user_details",
                "col" => "3",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],

            [
                "key" => 'designation',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.designation',
                "placeholder" => 'user::user.placeholder.designation',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'user_type',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.user_type',
                "placeholder" => 'user::user.placeholder.user_type',
                "rules" => '',
                "options" => function () {
                    return trans('user::user.options.user_type');
                },
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'doj',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::user.label.doj',
                "placeholder" => 'user::user.placeholder.doj',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'dob',
                "element" => 'date',
                "type" => 'date',
                "label" => 'user::user.label.dob',
                "placeholder" => 'user::user.placeholder.dob',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'experience',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.experience',
                "placeholder" => 'user::user.placeholder.experience',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'rera',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.rera',
                "placeholder" => 'user::user.placeholder.rera',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => "phone",
                "type" => "phone",
                "element" => "phone",
                'col' => 6,
                "label" => 'user::user.label.phone',
                'sort' => true,
                'placeholder' => 'user::user.placeholder.phone',
                'group' => 'main.user_details',
                'roles' => [],
            ],
            [
                "key" => "email",
                "type" => "email",
                "element" => "email",
                'col' => 6,
                "label" => 'user::user.label.email',
                'sort' => true,
                'placeholder' => 'user::user.placeholder.email',
                'group' => 'main.user_details',
                'roles' => [],
            ],
            [
                "key" => 'education',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.education',
                "placeholder" => 'user::user.placeholder.education',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "12",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],

            [
                'key' => 'languages',
                'element' => 'selectMultiple',
                'type' => 'selectMultiple',
                'label' => 'user::user.label.languages',
                'placeholder' => 'user::user.placeholder.languages',
                'rules' => '',
                "options" => function () {
                    return trans('user::user.options.languages');
                },
                'group' => 'main.user_details',
                'col' => '12',
                'isMultiple' => true
            ],
            [
                "key" => 'street',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.street',
                "placeholder" => 'user::user.placeholder.street',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'city',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.city',
                "placeholder" => 'user::user.placeholder.city',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'region',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.region',
                "placeholder" => 'user::user.placeholder.region',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'state',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.state',
                "placeholder" => 'user::user.placeholder.state',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'country',
                "element" => 'text',
                "type" => 'text',
                "label" => 'user::user.label.country',
                "placeholder" => 'user::user.placeholder.country',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "4",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                "key" => 'address',
                "element" => 'textarea',
                "type" => 'textarea',
                "label" => 'user::user.label.address',
                "placeholder" => 'user::user.placeholder.address',
                "rules" => '',
                "group" => "main.user_details",
                "col" => "12",
                "append" => null,
                "prepend" => null,
                "roles" => [],
                "attributes" => [
                    'wrapper' => [],
                    "label" => [],
                    "element" => [],

                ],
            ],
            [
                'key' => 'photo',
                'element' => 'images',
                'type' => 'images',
                'label' => 'user::user.label.photo',
                'placeholder' => 'user::user.placeholder.photo',
                'rules' => '',
                'group' => 'main.photo_gallery',
                'col' => '12',
                'append' => null,
                'prepend' => null,
                'roles' => [],
                'attributes' => [
                    'wrapper' => [],
                    'label' => [],
                    'element' => [],
                ],

            ],
            [
                'key' => 'roles',
                'element' => 'multi_checks',
                'type' => 'multi_checks',
                'label' => 'user::user.label.roles',
                'placeholder' => 'user::user.placeholder.roles',
                'rules' => '',
                'group' => 'main.roles',
                'col' => '12',
                'append' => null,
                'prepend' => null,
                'roles' => [],
                'options' => function () {
                    return trans('user::user.options.roles');
                },
                'attributes' => [
                    'wrapper' => [],
                    'label' => [],
                    'element' => [],
                ],
            ],

        ],

        'urls' => [
            'new' => [
                'url' => 'user/user/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'user/user/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'user/user',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'user/user',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'user/user',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'user/user',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'user::user.label.created_at',
            'name' => 'user::user.label.name',
            'status' => 'user::user.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "user::user.groups.main",
                'group' => "main.main",
                'title' => "user::user.groups.main",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "user::user.groups.images",
                'group' => "main.images",
                'title' => "user::user.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "user::user.groups.settings",
                'group' => "main.documents",
                'title' => "user::user.groups.settings",
            ],
            'user_login_details' => [
                'icon' => 'fa:home',
                'name' => 'user::user.groups.user_login_details',
                'group' => 'main.user_login_details',
                'title' => 'offplan::unit.groups.user_login_details',
                'type' => 'tab',
                'key' => 'user_login_details',
            ],
            'user_details' => [
                'icon' => 'fa:home',
                'name' => 'user::user.groups.user_details',
                'group' => 'main.user_details',
                'title' => 'offplan::unit.groups.user_details',
                'type' => 'tab',
                'key' => 'user_details',
            ],
            'photo_gallery' => [
                'icon' => 'bi:images',
                'name' => 'user::user.groups.photo_gallery',
                'group' => 'main.photo_gallery',
                'title' => 'user::user.groups.photo_gallery',
                'type' => 'tab',
                'key' => 'photo_gallery',
            ],
            'roles' => [
                'icon' => 'fluent:text-description-ltr-20-filled',
                'name' => 'user::user.groups.roles',
                'group' => 'main.roles',
                'title' => 'user::user.groups.roles',
                'type' => 'tab',
                'key' => 'roles',
            ],
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'User',
            'module' => 'User',
        ],
        'actions' => [
            'delete' => [
                'type' => ['Details'],
                'is_mobile' => 'true',
                'label' => 'user::user.actions.delete',
                'is_mobile' => 'true',
                'roles' => [
                    'user' => ['superuser', '*'],
                ],
                'meta' => [
                    'element' => 'navaction'
                ]
            ],
            'list' => [
                'type' => ['List'],
                'label' => 'user::user.actions.refresh',
                'roles' => [
                    'user' => ['*'],
                    'team' => [3, 4, 5]
                ],
            ],
            'create' => [
                'type' => ['List'],
                'label' => 'user::user.actions.create',
                'roles' => [
                    'user' => ['*'],
                    'team' => [3, 4, 5]
                ],
            ],
        ],
        'filters' => [
            [
                'target' => 'users',
                'label' => "developer::developer.label.users",
                'icon' => "fa-solid:user-tie",
                'name' =>  "developer::developer.label.users",
            ],
            [
                'target' => 'campaign',
                'label' => "developer::developer.label.campaign",
                'icon' => "fa6-regular:handshake",
                'name' =>  "developer::developer.label.campaign",
            ],
            [
                'target' => 'developer',
                'label' => "developer::developer.label.developer",
                'icon' => "fa6-regular:building",
                'name' =>  "developer::developer.label.developer",
            ],
            [
                'target' => 'description',
                'label' => "developer::developer.label.description",
                'icon' => "fluent:text-description-20-regular",
                'name' =>  "developer::developer.label.description",
            ],
            [
                'target' => '/admin/location/country',
                'label' => "location::location.label.location",
                'icon' => "fa-solid:map",
                'name' =>  "location::location.label.location",
            ]
        ]

    ]
];
