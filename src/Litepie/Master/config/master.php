<?php

return [

    /**
     * Provider.
     */
    'provider'  => 'litepie',

    /*
     * Package.
     */
    'package'   => 'master',

    /*
     * Modules.
     */
    'modules'   => ['master'],

        /**
     * Type of masters used in the project.
     */
    'masters' => [
        'single' => [
            'group' => 'main',
            'type' => 'single',
            'fields' => ['icon', 'amount', 'image'],
        ],
        'category' => [
            'group' => 'main',
            'type' => 'category',
            'fields' => ['parent_id'],
        ],
        'image' => [
            'group' => 'main',
            'type' => 'image',
            'fields' => ['image'],
        ],
        'icon' => [
            'group' => 'main',
            'type' => 'icon',
            'fields' => ['icon'],
        ],
        'project' => [
            'type' => 'project',
            'group' => 'project',
            'fields' => ['icon'],
        ],
    ],

    /**
     * Type of masters used in the project.
     */
    'groups' => [
        'default',
    ],
    'master' => [
        'model' => [
            'model' => \Litepie\Master\Models\Master::class,
            'table' => 'masters',
            'hidden' => [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['parent_id', 'type', 'name', 'code', 'amount', 'abbr', 'description', 'icon', 'image', 'images', 'file', 'order', 'status', 'extras'],
            'translatables' => [],
            'upload_folder' => 'master/master',
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
            'search' => [
                'name' => 'like',
                'status',
            ],
        ],

        'search' => [

        ],

        'list' => [
        ],

        'form' => [
            [
                "key" => 'type',
                "element" => 'hidden',
                "type" => 'hidden',
                "label" => 'master::master.label.type',
                "placeholder" => 'master::master.placeholder.type',
                "rules" => '',
                "group" => "main.main",
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
                "label" => 'master::master.label.name',
                "placeholder" => 'master::master.placeholder.name',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'code',
                "element" => 'text',
                "type" => 'text',
                "label" => 'master::master.label.code',
                "placeholder" => 'master::master.placeholder.code',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'amount',
                "element" => 'decimal',
                "type" => 'decimal',
                "label" => 'master::master.label.amount',
                "placeholder" => 'master::master.placeholder.amount',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'abbr',
                "element" => 'textarea',
                "type" => 'textarea',
                "label" => 'master::master.label.abbr',
                "placeholder" => 'master::master.placeholder.abbr',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'description',
                "element" => 'textarea',
                "type" => 'textarea',
                "label" => 'master::master.label.description',
                "placeholder" => 'master::master.placeholder.description',
                "rules" => '',
                "group" => "main.main",
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
                "key" => 'icon',
                "element" => 'text',
                "type" => 'text',
                "label" => 'master::master.label.icon',
                "placeholder" => 'master::master.placeholder.icon',
                "rules" => '',
                "group" => "main.main",
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
            ]
        ],

        'urls' => [
            'new' => [
                'url' => 'master/master/single',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'master/master',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'master/master',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'master/master',
                'method' => 'GET',
            ],
            'delete' => [
                'url' => 'master/master',
                'method' => 'DELETE',
            ],
        ],
        'order' => [
            'created_at' => 'master::master.label.created_at',
            'name' => 'master::master.label.name',
            'status' => 'master::master.label.status',
        ],
        'groups' => [
            'main' => [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "master::master.groups.main",
                'group' => "main.main",
                'title' => "master.master.groups.main",
            ],
            'details' => [
                'icon' => "fe:home",
                'name' => "master::master.groups.details",
                'group' => "main.documents",
                'title' => "master.master.groups.details",
            ],
            'images' => [
                'icon' => "fe:home",
                'name' => "master::master.groups.images",
                'group' => "main.documents",
                'title' => "master.master.groups.images",
            ],
            'settings' => [
                'icon' => "fe:home",
                'name' => "master::master.groups.settings",
                'group' => "main.documents",
                'title' => "master.master.groups.settings",
            ],
        ],
        'controller' => [
            'provider' => 'Litepie',
            'package' => 'Master',
            'module' => 'Master',
        ],

        'actions' => [
            'copy' => [
                'type' => ['Details', 'List'],
                'label' => 'master::master.action.copy',
                'roles' => [
                    'user' => ['superuser', 'admin'],
                    'team' => ['admin'],
                    'permission' => ['master.master.copy', 'master.master.duplicate'],
                ],
                'form' => [
                    'count' => [
                        "element" => 'select',
                        "type" => 'select',
                        "label" => 'master::master.label.count',
                        "placeholder" => 'master::master.placeholder.count',
                        "options" => call_user_func(function () {
                            return [
                                1 => ['value' => 1, 'text' => 1],
                                2 => ['value' => 2, 'text' => 2],
                                3 => ['value' => 3, 'text' => 3],
                                4 => ['value' => 4, 'text' => 4],
                            ];
                        }),
                        "col" => "12",
                    ],
                    'comment' => [
                        "element" => 'textarea',
                        "type" => 'text',
                        "required" => 'required',
                        "label" => 'master::master.label.comment',
                        "placeholder" => 'master::master.placeholder.comment',
                        "col" => "12",
                    ],
                ],
            ],
            'empty' => [
                'type' => ['List', 'Details'],
                'label' => 'master::master.action.empty',
                'roles' => [
                    'user' => ['superuser'],
                ],
            ],
        ],
    ],

];
