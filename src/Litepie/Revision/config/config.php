<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package'  => 'revision',

    /*
     * Modules.
     */
    'modules'  => ['revision','activity'],

    'image'    => [

        'sm' => [
            'width'     => '140',
            'height'    => '140',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'md' => [
            'width'     => '370',
            'height'    => '420',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

        'lg' => [
            'width'     => '780',
            'height'    => '497',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],
        'xl' => [
            'width'     => '800',
            'height'    => '530',
            'action'    => 'fit',
            'watermark' => 'img/logo/default.png',
        ],

    ],

    'revision'     => [
        'model'         => 'Litepie\Revision\Models\Revision',
        'table'         => 'revisions',
        'presenter'     => \Litepie\Revision\Repositories\Presenter\RevisionItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'title'         => 'field',
        'slugs'         => ['slug' => 'field'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['id', 'user_type', 'user_id', 'field', 'cast', 'old_value', 'new_value', 'revision_type', 'revision_id', 'created_at', 'updated_at'],
        'translate'     => [],

        'upload_folder' => '/revision/revision',
        'uploads'       => [],
        'casts'         => [
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'field' => 'like',
            'revision_type' => 'like',
            'created_at',
        ],
        'workflow'      => [
            'points' => [
                'start' => 'draft',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'draft'     => [
                    'label'  => "Revision created",
                    'action' => ['setStatus', 'draft'],
                    'next'   => [
                        'complete' => [
                            'target' => 'complete',
                        ],
                    ],
                ],
                'complete'  => [
                    'label'  => "Revision completed",
                    'status' => ['setStatus', 'complete'],
                    'next'   => [
                        'verify' => [
                            'target' => 'verify',
                        ],
                    ],
                ],
                'verify'    => [
                    'label'  => "Revision verified",
                    'status' => ['setStatus', 'verify'],
                    'next'   => [
                        'approve' => [
                            'target' => 'approve',
                        ],
                    ],
                ],
                'approve'   => [
                    'label'  => "Revision approved",
                    'status' => ['setStatus', 'approve'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                    ],
                ],
                'publish'   => [
                    'label'  => "Revision published",
                    'status' => ['setStatus', 'publish'],
                    'next'   => [
                        'unpublish' => [
                            'target' => 'unpublish',
                        ],
                        'delete'    => [
                            'target' => 'delete',
                        ],
                        'archive'   => [
                            'target' => 'archive',
                        ],
                    ],
                ],
                'unpublish' => [
                    'label'  => "Revision unpublished",
                    'status' => ['setStatus', 'unpublish'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'archive' => [
                            'target' => 'archive',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'archive'   => [
                    'label'  => "Revision archived",
                    'status' => ['setStatus', 'archive'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'delete'    => [
                    'Label'  => "Revision deleted",
                    'status' => ['delete', 'archive'],
                    'next'   => '~',
                ],
            ],
        ],
    ],

    'activity'     => [
        'model'         => 'Litepie\Revision\Models\Activity',
        'table'         => 'activities',
        'presenter'     => \Litepie\Revision\Repositories\Presenter\ActivityItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'title'         => 'name',
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['id', 'user_type', 'user_id', 'action', 'name', 'activity_type', 'activity_id', 'user_info', 'created_at'],
        'translate'     => [],

        'upload_folder' => '/revision/revision',
        'uploads'       => [],
        'casts'         => [
            'user_info' => 'array',
        ],
        'revision'      => [],
        'perPage'       => '20',
        'search'        => [
            'name' => 'like',
            'action' => 'like',
            'activity_type' => 'like',
        ],
        'workflow'      => [
            'points' => [
                'start' => 'draft',
                'end'   => ['delete'],
            ],
            'steps'  => [
                'draft'     => [
                    'label'  => "Activity created",
                    'action' => ['setStatus', 'draft'],
                    'next'   => [
                        'complete' => [
                            'target' => 'complete',
                        ],
                    ],
                ],
                'complete'  => [
                    'label'  => "Activity completed",
                    'status' => ['setStatus', 'complete'],
                    'next'   => [
                        'verify' => [
                            'target' => 'verify',
                        ],
                    ],
                ],
                'verify'    => [
                    'label'  => "Activity verified",
                    'status' => ['setStatus', 'verify'],
                    'next'   => [
                        'approve' => [
                            'target' => 'approve',
                        ],
                    ],
                ],
                'approve'   => [
                    'label'  => "Activity approved",
                    'status' => ['setStatus', 'approve'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                    ],
                ],
                'publish'   => [
                    'label'  => "Activity published",
                    'status' => ['setStatus', 'publish'],
                    'next'   => [
                        'unpublish' => [
                            'target' => 'unpublish',
                        ],
                        'delete'    => [
                            'target' => 'delete',
                        ],
                        'archive'   => [
                            'target' => 'archive',
                        ],
                    ],
                ],
                'unpublish' => [
                    'label'  => "Activity unpublished",
                    'status' => ['setStatus', 'unpublish'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'archive' => [
                            'target' => 'archive',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'archive'   => [
                    'label'  => "Activity archived",
                    'status' => ['setStatus', 'archive'],
                    'next'   => [
                        'publish' => [
                            'target' => 'publish',
                        ],
                        'delete'  => [
                            'target' => 'delete',
                        ],
                    ],
                ],
                'delete'    => [
                    'Label'  => "Activity deleted",
                    'status' => ['delete', 'archive'],
                    'next'   => '~',
                ],
            ],
        ],
    ],
];
