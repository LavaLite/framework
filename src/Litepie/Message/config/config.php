<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package'  => 'message',

    /*
     * Modules.
     */
    'modules'  => ['message'],

    'message'  => [
        'model'         => 'Litepie\Message\Models\Message',
        'table'         => 'messages',
        'presenter'     => \Litepie\Message\Repositories\Presenter\MessageItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'user_type', 'status', 'star', 'from', 'to', 'subject', 'message', 'read', 'type', 'upload_folder'],
        'translatables' => [],

        'upload_folder' => '/message/message',
        'uploads'       => [],
        'casts'         => [
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',
            'status',
        ],
    ],
];
