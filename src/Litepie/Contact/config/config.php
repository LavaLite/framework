<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'litepie'  => 'contact',

    /*
     * Contact mail address should be send to.
     */
    'to'       => 'info@lavalite.org',

    /*
     * CC for contact us mail.
     */
    'cc'       => 'info@lavalite.org',

    /*
     * Modules.
     */
    'modules'  => ['contact'],

    'contact'  => [
        'model'         => 'Litepie\Contact\Models\Contact',
        'table'         => 'contacts',
        'presenter'     => \Litepie\Contact\Repositories\Presenter\ContactItemPresenter::class,
        'hidden'        => [],
        'visible'       => [],
        'guarded'       => ['*'],
        'slugs'         => ['slug' => 'name'],
        'dates'         => ['deleted_at'],
        'appends'       => [],
        'fillable'      => ['user_id', 'user_type', 'name', 'phone', 'mobile', 'email', 'website', 'address','upload_folder'],
        'translatables' => [],

        'upload_folder' => '/contact/contact',
        'uploads'       => [
            'single'   => [],
            'multiple' => [],
        ],
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
