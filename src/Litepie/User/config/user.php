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
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'email',  'password',  'api_token',  'remember_token',  'sex',  'dob',  'designation',  'mobile',  'phone',  'address',  'street',  'city',  'Region',  'state',  'country',  'photo',  'web',  'status',  'email_verified_at',  'user_id',  'user_type'],
            'translatables' => [],
            'upload_folder' => 'user/client',
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
            */
            ],

            'casts' => [
            
            /*
                'images'    => 'array',
                'file'      => 'array',
            */
            ],

            'revision' => [],
            'perPage' => '20',
            'search'        => [
                'name'  => 'like',
                'status',
            ]
        ],

        'search' => [
            
        ],

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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "options" => function(){
                    return trans('user::client.options.sex');
                },
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "user::client.groups.main",
                'key' => "main",
                'title' => "user::client.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "user::client.groups.details",
                'key' => "documents",
                'title' => "user::client.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "user::client.groups.images",
                'key' => "documents",
                'title' => "user::client.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "user::client.groups.settings",
                'key' => "documents",
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
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['team_id',  'reporting_to',  'name',  'email',  'password',  'api_token',  'remember_token',  'sex',  'dob',  'doj',  'designation',  'mobile',  'phone',  'address',  'street',  'city',  'region',  'state',  'country',  'photo',  'web',  'social_urls',  'status',  'email_verified_at',  'user_id',  'user_type'],
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
            */
            ],

            'casts' => [
            
            /*
                'images'    => 'array',
                'file'      => 'array',
            */
            ],

            'revision' => [],
            'perPage' => '20',
            'search'        => [
                'name'  => 'like',
                'status',
            ]
        ],

        'search' => [
            
        ],

        'list' => [
            [
                "key" => "team_id", 
                "type" => "text", 
                "label" => 'user::user.label.team_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "reporting_to", 
                "type" => "text", 
                "label" => 'user::user.label.reporting_to', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "name", 
                "type" => "text", 
                "label" => 'user::user.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "email", 
                "type" => "text", 
                "label" => 'user::user.label.email', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "sex", 
                "type" => "text", 
                "label" => 'user::user.label.sex', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "dob", 
                "type" => "text", 
                "label" => 'user::user.label.dob', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "doj", 
                "type" => "text", 
                "label" => 'user::user.label.doj', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "designation", 
                "type" => "text", 
                "label" => 'user::user.label.designation', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "mobile", 
                "type" => "text", 
                "label" => 'user::user.label.mobile', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "phone", 
                "type" => "text", 
                "label" => 'user::user.label.phone', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "address", 
                "type" => "text", 
                "label" => 'user::user.label.address', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "street", 
                "type" => "text", 
                "label" => 'user::user.label.street', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "city", 
                "type" => "text", 
                "label" => 'user::user.label.city', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "state", 
                "type" => "text", 
                "label" => 'user::user.label.state', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "country", 
                "type" => "text", 
                "label" => 'user::user.label.country', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "photo", 
                "type" => "text", 
                "label" => 'user::user.label.photo', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "web", 
                "type" => "text", 
                "label" => 'user::user.label.web', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "social_urls", 
                "type" => "text", 
                "label" => 'user::user.label.social_urls', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'team_id',
                "element" => 'select',
                "type" => 'select',
                "label" => 'user::user.label.team_id',
                "placeholder" => 'user::user.placeholder.team_id',
                "rules" => '',
                "options" => function(){
                    return trans('user::user.options.team_id');
                },
                "group" => "main",
                "section" => "first",
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
                "options" => function(){
                    return trans('user::user.options.reporting_to');
                },
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "options" => function(){
                    return trans('user::user.options.sex');
                },
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                "group" => "main",
                "section" => "first",
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
                'key' => "main",
                'title' => "user::user.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "user::user.groups.details",
                'key' => "documents",
                'title' => "user::user.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "user::user.groups.images",
                'key' => "documents",
                'title' => "user::user.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "user::user.groups.settings",
                'key' => "documents",
                'title' => "user::user.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'User',
            'module' => 'User',
        ],
    ]
];
