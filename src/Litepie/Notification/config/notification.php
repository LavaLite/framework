<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'notification',

    /*
     * Modules.
     */
    'modules'   => ['notification'],

    'notification' =>     [
        'model' => [
            'model' => \Litepie\Notification\Models\Notification::class,
            'table' => 'litepie_notification_notifications',
            'hidden'=> [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['type',  'type_sub',  'notifiable_id',  'notifiable_type',  'data',  'message',  'actions',  'variant',  'pinned',  'read_at'],
            'translatables' => [],
            'upload_folder' => 'notification/notification',
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
            "type" => [
                "key" => "type", 
                "col" => 4, 
                "operators" => ['LIKE', '=', 'IN', 'BETWEEN'], 
                "type" => "text", 
                "label" => 'notification::notification.label.type', 
                "placeholder" => 'notification::notification.placeholder.type', 
            ],
            "type_sub" => [
                "key" => "type_sub", 
                "col" => 4, 
                "operators" => ['LIKE', '=', 'IN', 'BETWEEN'], 
                "type" => "text", 
                "label" => 'notification::notification.label.type_sub', 
                "placeholder" => 'notification::notification.placeholder.type_sub', 
            ],
        ],

        'list' => [
            "type" => [
                "key" => "type", 
                "type" => "text", 
                "label" => 'notification::notification.label.type', 
                'sort' => true,
                'roles' => [],
            ],
            "type_sub" => [
                "key" => "type_sub", 
                "type" => "text", 
                "label" => 'notification::notification.label.type_sub', 
                'sort' => true,
                'roles' => [],
            ],
            "notifiable_id" => [
                "key" => "notifiable_id", 
                "type" => "text", 
                "label" => 'notification::notification.label.notifiable_id', 
                'sort' => true,
                'roles' => [],
            ],
            "notifiable_type" => [
                "key" => "notifiable_type", 
                "type" => "text", 
                "label" => 'notification::notification.label.notifiable_type', 
                'sort' => true,
                'roles' => [],
            ],
            "data" => [
                "key" => "data", 
                "type" => "text", 
                "label" => 'notification::notification.label.data', 
                'sort' => true,
                'roles' => [],
            ],
            "message" => [
                "key" => "message", 
                "type" => "text", 
                "label" => 'notification::notification.label.message', 
                'sort' => true,
                'roles' => [],
            ],
            "actions" => [
                "key" => "actions", 
                "type" => "text", 
                "label" => 'notification::notification.label.actions', 
                'sort' => true,
                'roles' => [],
            ],
            "variant" => [
                "key" => "variant", 
                "type" => "text", 
                "label" => 'notification::notification.label.variant', 
                'sort' => true,
                'roles' => [],
            ],
            "pinned" => [
                "key" => "pinned", 
                "type" => "text", 
                "label" => 'notification::notification.label.pinned', 
                'sort' => true,
                'roles' => [],
            ],
            "read_at" => [
                "key" => "read_at", 
                "type" => "text", 
                "label" => 'notification::notification.label.read_at', 
                'sort' => true,
                'roles' => [],
            ],
        ],

        'form' => [
            'type' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.type',
                "placeholder" => 'notification::notification.placeholder.type',
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
            'type_sub' => [
                "element" => 'select',
                "type" => 'select',
                "label" => 'notification::notification.label.type_sub',
                "placeholder" => 'notification::notification.placeholder.type_sub',
                "rules" => '',
                "options" => function(){
                    return [];
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
            'notifiable_id' => [
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'notification::notification.label.notifiable_id',
                "placeholder" => 'notification::notification.placeholder.notifiable_id',
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
            'notifiable_type' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.notifiable_type',
                "placeholder" => 'notification::notification.placeholder.notifiable_type',
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
            'data' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.data',
                "placeholder" => 'notification::notification.placeholder.data',
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
            'message' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.message',
                "placeholder" => 'notification::notification.placeholder.message',
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
            'actions' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.actions',
                "placeholder" => 'notification::notification.placeholder.actions',
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
            'variant' => [
                "element" => 'text',
                "type" => 'text',
                "label" => 'notification::notification.label.variant',
                "placeholder" => 'notification::notification.placeholder.variant',
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
            'pinned' => [
                "element" => 'numeric',
                "type" => 'numeric',
                "label" => 'notification::notification.label.pinned',
                "placeholder" => 'notification::notification.placeholder.pinned',
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
            'read_at' => [
                "element" => 'date_time_picker',
                "type" => 'date_time_picker',
                "label" => 'notification::notification.label.read_at',
                "placeholder" => 'notification::notification.placeholder.read_at',
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
                'url' => 'notification/notification/new',
                'method' => 'GET',
            ],
            'create' => [
                'url' => 'notification/notification/create',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'notification/notification',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'notification/notification',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'notification/notification',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'notification/notification',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'notification::notification.label.created_at',
            'name' => 'notification::notification.label.name',
            'status' => 'notification::notification.label.status',
        ],
        'groups' => [
            [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "notification::notification.groups.main",
                'group' => "main.main",
                'title' => "notification::notification.groups.main",
            ],
            [
                'icon' => "fe:home",
                'name' => "notification::notification.groups.details",
                'group' => "main.details",
                'title' => "notification::notification.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "notification::notification.groups.images",
                'group' => "main.images",
                'title' => "notification::notification.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "notification::notification.groups.settings",
                'group' => "main.settings",
                'title' => "notification::notification.groups.settings",
            ]
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Notification',
            'module' => 'Notification',
        ],
    ]
];
