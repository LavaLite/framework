<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'team',

    /*
     * Modules.
     */
    'modules'   => ['team'],

    'team' => [
        'model' => [
            'model' => \Litepie\Team\Models\Team::class,
            'table' => 'teams',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'key',  'level',  'type',  'status',  'description',  'settings'],
            'translatables' => [],
            'upload_folder' => 'team/team',
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
                "label" => 'team::team.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "key", 
                "type" => "text", 
                "label" => 'team::team.label.key', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "level", 
                "type" => "text", 
                "label" => 'team::team.label.level', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "type", 
                "type" => "text", 
                "label" => 'team::team.label.type', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "description", 
                "type" => "text", 
                "label" => 'team::team.label.description', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "settings", 
                "type" => "text", 
                "label" => 'team::team.label.settings', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'team::team.label.name',
                "placeholder" => 'team::team.placeholder.name',
                "rules" => '',
                "group" => "main.main",
                "col" => "5",
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
                "label" => 'team::team.label.key',
                "placeholder" => 'team::team.placeholder.key',
                "rules" => '',
                "group" => "main.main",
                "col" => "5",
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
                "label" => 'team::team.label.level',
                "placeholder" => 'team::team.placeholder.level',
                "rules" => '',
                "options" => function(){
                    return trans('team::team.options.level');
                },
                "group" => "main.main",
                "col" => "2",
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
                "key" => 'type',
                "element" => 'select',
                "type" => 'select',
                "label" => 'team::team.label.type',
                "placeholder" => 'team::team.placeholder.type',
                "rules" => '',
                "options" => function(){
                    return trans('team::team.options.type');
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
                "key" => 'status',
                "element" => 'radios',
                "type" => 'radios',
                "label" => 'team::team.label.status',
                "placeholder" => 'team::team.placeholder.status',
                "rules" => '',
                "options" => function(){
                    return trans('team::team.options.status');
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
                "key" => 'description',
                "element" => 'text',
                "type" => 'text',
                "label" => 'team::team.label.description',
                "placeholder" => 'team::team.placeholder.description',
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
                "key" => 'settings',
                "element" => 'textarea',
                "type" => 'text',
                "label" => 'team::team.label.settings',
                "placeholder" => 'team::team.placeholder.settings',
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
                'url' => 'team/team/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'team/team/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'team/team',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'team/team',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'team/team',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'team/team',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'team::team.label.created_at',
            'name' => 'team::team.label.name',
            'status' => 'team::team.label.status',
        ],
        'groups' => [
            [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "team::team.groups.main",
                'group' => "main.main",
                'title' => "team::team.groups.main",
            ],
            [
                'icon' => "fe:home",
                'name' => "team::team.groups.members",
                'group' => "main.members",
                'title' => "team::team.groups.members",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Team',
            'module' => 'Team',
        ],
    ]
];