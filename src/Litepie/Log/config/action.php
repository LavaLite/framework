<?php


return  
    [
        'model' => [
            'model' => \Litepie\Log\Models\Action::class,
            'table' => 'litepie_log_actions',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['action',  'description',  'subject_id',  'subject_type',  'causer_id',  'causer_type',  'transition',  'duration',  'properties'],
            'translatables' => [],
            'upload_folder' => 'log/action',
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
                "key" => "action", 
                "type" => "text", 
                "label" => 'log::action.label.action', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "description", 
                "type" => "text", 
                "label" => 'log::action.label.description', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "subject_id", 
                "type" => "text", 
                "label" => 'log::action.label.subject_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "subject_type", 
                "type" => "text", 
                "label" => 'log::action.label.subject_type', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "causer_id", 
                "type" => "text", 
                "label" => 'log::action.label.causer_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "causer_type", 
                "type" => "text", 
                "label" => 'log::action.label.causer_type', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "transition", 
                "type" => "text", 
                "label" => 'log::action.label.transition', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "duration", 
                "type" => "text", 
                "label" => 'log::action.label.duration', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "properties", 
                "type" => "text", 
                "label" => 'log::action.label.properties', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'action',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.action',
                "placeholder" => 'log::action.placeholder.action',
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
                "key" => 'description',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.description',
                "placeholder" => 'log::action.placeholder.description',
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
                "key" => 'subject_id',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'log::action.label.subject_id',
                "placeholder" => 'log::action.placeholder.subject_id',
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
                "key" => 'subject_type',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.subject_type',
                "placeholder" => 'log::action.placeholder.subject_type',
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
                "key" => 'causer_id',
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'log::action.label.causer_id',
                "placeholder" => 'log::action.placeholder.causer_id',
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
                "key" => 'causer_type',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.causer_type',
                "placeholder" => 'log::action.placeholder.causer_type',
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
                "key" => 'transition',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.transition',
                "placeholder" => 'log::action.placeholder.transition',
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
                "key" => 'duration',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.duration',
                "placeholder" => 'log::action.placeholder.duration',
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
                "key" => 'properties',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::action.label.properties',
                "placeholder" => 'log::action.placeholder.properties',
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
                'url' => 'log/action/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'log/action/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'log/action',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'log/action',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'log/action',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'log/action',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'log::action.label.created_at',
            'name' => 'log::action.label.name',
            'status' => 'log::action.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "log::action.groups.main",
                'key' => "main",
                'title' => "log::action.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "log::action.groups.details",
                'key' => "documents",
                'title' => "log::action.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "log::action.groups.images",
                'key' => "documents",
                'title' => "log::action.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "log::action.groups.settings",
                'key' => "documents",
                'title' => "log::action.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Log',
            'module' => 'Action',
        ],

        
        
    ];
