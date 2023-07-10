<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'menu',

    /*
     * Modules.
     */
    'modules'   => ['menu'],
    
    'menu' => [
        'model' => [
            'model' => \Litepie\Menu\Models\Menu::class,
            'table' => 'menus',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => ['eid'],
            'fillable' => ['parent_id',  'key',  'url',  'icon',  'permission',  'role',  'name',  'description',  'target',  'order',  'uload_folder',  'status'],
            'translatables' => [],
            'upload_folder' => 'menu/menu',
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

            'casts'             => [
                'role' => 'array',
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
                "key" => "parent_id", 
                "type" => "text", 
                "label" => 'menu::menu.label.parent_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "key", 
                "type" => "text", 
                "label" => 'menu::menu.label.key', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "url", 
                "type" => "text", 
                "label" => 'menu::menu.label.url', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "icon", 
                "type" => "text", 
                "label" => 'menu::menu.label.icon', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "permission", 
                "type" => "text", 
                "label" => 'menu::menu.label.permission', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "role", 
                "type" => "text", 
                "label" => 'menu::menu.label.role', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "name", 
                "type" => "text", 
                "label" => 'menu::menu.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "description", 
                "type" => "text", 
                "label" => 'menu::menu.label.description', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "target", 
                "type" => "text", 
                "label" => 'menu::menu.label.target', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "order", 
                "type" => "text", 
                "label" => 'menu::menu.label.order', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "uload_folder", 
                "type" => "text", 
                "label" => 'menu::menu.label.uload_folder', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'parent_id',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'menu::menu.label.parent_id',
                "placeholder" => 'menu::menu.placeholder.parent_id',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'key',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.key',
                "placeholder" => 'menu::menu.placeholder.key',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'url',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.url',
                "placeholder" => 'menu::menu.placeholder.url',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'icon',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.icon',
                "placeholder" => 'menu::menu.placeholder.icon',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'permission',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.permission',
                "placeholder" => 'menu::menu.placeholder.permission',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'role',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.role',
                "placeholder" => 'menu::menu.placeholder.role',
                "rules" => '',
                "group" => "mani.main",
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
                "label" => 'menu::menu.label.name',
                "placeholder" => 'menu::menu.placeholder.name',
                "rules" => '',
                "group" => "mani.main",
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
                "label" => 'menu::menu.label.description',
                "placeholder" => 'menu::menu.placeholder.description',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'target',
                "element" => 'radios',
                "type" => 'radios',
                "label" => 'menu::menu.label.target',
                "placeholder" => 'menu::menu.placeholder.target',
                "rules" => '',
                "options" => function(){
                    return trans('menu::menu.options.target');
                },
                "group" => "mani.main",
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
                "key" => 'order',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'menu::menu.label.order',
                "placeholder" => 'menu::menu.placeholder.order',
                "rules" => '',
                "group" => "mani.main",
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
                "key" => 'uload_folder',
                "element" => 'text',
                "type" => 'text',
                "label" => 'menu::menu.label.uload_folder',
                "placeholder" => 'menu::menu.placeholder.uload_folder',
                "rules" => '',
                "group" => "mani.main",
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
                'url' => 'menu/menu/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'menu/menu/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'menu/menu',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'menu/menu',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'menu/menu',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'menu/menu',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'menu::menu.label.created_at',
            'name' => 'menu::menu.label.name',
            'status' => 'menu::menu.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "menu::menu.groups.main",
                'group' => "main.main",
                'title' => "menu::menu.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "menu::menu.groups.details",
                'group' => "main.documents",
                'title' => "menu::menu.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "menu::menu.groups.images",
                'group' => "main.documents",
                'title' => "menu::menu.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "menu::menu.groups.settings",
                'group' => "main.documents",
                'title' => "menu::menu.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Menu',
            'module' => 'Menu',
        ],

        
        
    ]
];
