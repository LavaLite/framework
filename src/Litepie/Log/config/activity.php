<?php


return  
    [
        'model' => [
            'model' => \Litepie\Log\Models\Activity::class,
            'table' => 'litepie_log_activities',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['name',  'description',  'subject_id',  'subject_type',  'causer_id',  'causer_type',  'properties'],
            'translatables' => [],
            'upload_folder' => 'log/activity',
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
                "label" => 'log::activity.label.name', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "description", 
                "type" => "text", 
                "label" => 'log::activity.label.description', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "subject_id", 
                "type" => "text", 
                "label" => 'log::activity.label.subject_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "subject_type", 
                "type" => "text", 
                "label" => 'log::activity.label.subject_type', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "causer_id", 
                "type" => "text", 
                "label" => 'log::activity.label.causer_id', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "causer_type", 
                "type" => "text", 
                "label" => 'log::activity.label.causer_type', 
                'sort' => true,
                'roles' => [],
            ],
            [
                "key" => "properties", 
                "type" => "text", 
                "label" => 'log::activity.label.properties', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            [
                "key" => 'name',
                "element" => 'text',
                "type" => 'text',
                "label" => 'log::activity.label.name',
                "placeholder" => 'log::activity.placeholder.name',
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
                "label" => 'log::activity.label.description',
                "placeholder" => 'log::activity.placeholder.description',
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
                "label" => 'log::activity.label.subject_id',
                "placeholder" => 'log::activity.placeholder.subject_id',
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
                "label" => 'log::activity.label.subject_type',
                "placeholder" => 'log::activity.placeholder.subject_type',
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
                "label" => 'log::activity.label.causer_id',
                "placeholder" => 'log::activity.placeholder.causer_id',
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
                "label" => 'log::activity.label.causer_type',
                "placeholder" => 'log::activity.placeholder.causer_type',
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
                "label" => 'log::activity.label.properties',
                "placeholder" => 'log::activity.placeholder.properties',
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
                'url' => 'log/activity/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'log/activity/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'log/activity',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'log/activity',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'log/activity',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'log/activity',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'log::activity.label.created_at',
            'name' => 'log::activity.label.name',
            'status' => 'log::activity.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "log::activity.groups.main",
                'key' => "main",
                'title' => "log::activity.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "log::activity.groups.details",
                'key' => "documents",
                'title' => "log::activity.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "log::activity.groups.images",
                'key' => "documents",
                'title' => "log::activity.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "log::activity.groups.settings",
                'key' => "documents",
                'title' => "log::activity.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Log',
            'module' => 'Activity',
        ],

        
        
    ];
