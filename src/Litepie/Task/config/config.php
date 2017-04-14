<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package'  => 'task',

    /*
     * Modules.
     */
    'modules'  => ['task'],

    'task'     => [
        'model'         => 'Litepie\Task\Models\Task',
        'table'         => 'tasks',
        'presenter'     => \Litepie\Task\Repositories\Presenter\TaskItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'task'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'user_type', 'parent_id', 'start', 'end', 'category', 'task', 'time_required', 'time_taken', 'priority', 'status', 'upload_folder', 'created_by'],

        'upload_folder' => '/task/task',
        'uploads'       => [],
        'casts'         => [
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'task' => 'like',
            'status',
        ],
    ],
];
