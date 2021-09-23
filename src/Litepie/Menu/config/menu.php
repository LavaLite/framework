<?php

return [

    /*
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package' => 'menu',

    /*
     * Modules.
     */
    'modules' => ['menu'],

    'menu' => [
        'model' => [
            'model'         => 'Litepie\Menu\Models\Menu',
            'repository'    => Litepie\Menu\Interfaces\MenuRepositoryInterface::class,
            'table'         => 'menus',
            'hidden'        => [],
            'visible'       => [],
            'guarded'       => ['*'],
            'slugs'         => ['slug' => 'name'],
            'dates'         => ['deleted_at'],
            'appends'       => ['has_role'],
            'fillable'      => ['user_id', 'parent_id', 'key', 'url', 'icon', 'permission', 'role', 'name', 'description', 'target', 'order', 'uload_folder', 'status'],
            'translate'     => ['parent_id', 'key', 'url', 'icon', 'permission', 'role', 'name', 'description', 'target', 'order', 'uload_folder'],
            'upload_folder' => 'menu/menu',
            'uploads'       => [],
            'casts'         => [
                'role' => 'array',
            ],
            'revision' => [],
            'perPage'  => '20',
            'search'   => [
                'name' => 'like',
                'key'  => 'like',
                'status',
            ],
        ],

    ],
];
