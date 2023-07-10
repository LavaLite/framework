<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'role',

    /*
     * Modules.
     */
    'modules'   => ['role', 'permission'],

    'permission' => [
        'model' => [
            'model' => \Litepie\Role\Models\Permission::class,
            'table' => 'permissions',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'description'],
            'translatables' => [],
            'upload_folder' => 'role/permission',
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
                "label" => 'role::permission.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "slug", 
                "type" => "text", 
                "label" => 'role::permission.label.slug', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::permission.label.name',
                "placeholder" => 'role::permission.placeholder.name',
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
                "key" => 'slug',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::permission.label.slug',
                "placeholder" => 'role::permission.placeholder.slug',
                "required" => 'true',
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
                "key" => 'description',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::permission.label.description',
                "placeholder" => 'role::permission.placeholder.description',
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
        ],

        'urls' => [
            'new' => [
                'url' => 'role/permission/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'role/permission/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'role/permission',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'role/permission',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'role/permission',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'role/permission',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'role::permission.label.created_at',
            'name' => 'role::permission.label.name',
            'status' => 'role::permission.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "role::permission.groups.main",
                'group' => "main.main",
                'title' => "role::permission.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "role::permission.groups.details",
                'group' => "main.documents",
                'title' => "role::permission.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "role::permission.groups.images",
                'group' => "main.documents",
                'title' => "role::permission.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "role::permission.groups.settings",
                'group' => "main.documents",
                'title' => "role::permission.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Role',
            'module' => 'Permission',
        ],

        
        
    ],

    'role' => [
        'model' => [
            'model' => \Litepie\Role\Models\Role::class,
            'table' => 'roles',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'description',  'level'],
            'translatables' => [],
            'upload_folder' => 'role/role',
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
            "name" => [
                "key" => "name", 
                "col" => 4, 
                "operators" => ['LIKE', '=', 'IN', 'BETWEEN'], 
                "type" => "text", 
                "label" => 'role::role.label.name', 
                "placeholder" => 'role::role.placeholder.name', 
            ],
            "slug" => [
                "key" => "slug", 
                "col" => 4, 
                "operators" => ['LIKE', '=', 'IN', 'BETWEEN'], 
                "type" => "text", 
                "label" => 'role::role.label.slug', 
                "placeholder" => 'role::role.placeholder.slug', 
            ],
        ],

        'list' => [
            [
                "key" => "name", 
                "type" => "text", 
                "label" => 'role::role.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "slug", 
                "type" => "text", 
                "label" => 'role::role.label.slug', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "level", 
                "type" => "text", 
                "label" => 'role::role.label.level', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::role.label.name',
                "placeholder" => 'role::role.placeholder.name',
                "required" => 'true',
                "group" => "main.main",
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
                "key" => 'slug',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::role.label.slug',
                "placeholder" => 'role::role.placeholder.slug',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'level',
                "element" => 'select',
                "type" => 'select',
                "label" => 'role::role.label.level',
                "placeholder" => 'role::role.placeholder.level',
                "rules" => '',
                "options" => function(){
                    return trans('role::role.options.level');
                },
                "group" => "main.main",
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
                "key" => 'description',
                "element" => 'text',
                "type" => 'text',
                "label" => 'role::role.label.description',
                "placeholder" => 'role::role.placeholder.description',
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
        ],

        'urls' => [
            'new' => [
                'url' => 'role/role/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'role/role/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'role/role',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'role/role',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'role/role',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'role/role',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'role::role.label.created_at',
            'name' => 'role::role.label.name',
            'status' => 'role::role.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "role::role.groups.main",
                'group' => "main.main",
                'title' => "role::role.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "role::role.groups.details",
                'group' => "main.documents",
                'title' => "role::role.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "role::role.groups.images",
                'group' => "main.documents",
                'title' => "role::role.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "role::role.groups.settings",
                'group' => "main.documents",
                'title' => "role::role.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Role',
            'module' => 'Role',
        ],

        
        
    ]
];
