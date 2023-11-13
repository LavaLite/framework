<?php

return [

    /**
     * Provider.
     */
    'provider' => 'litepie',

    /*
     * Package.
     */
    'package' => 'setting',

    /*
     * Modules.
     */
    'modules' => ['setting'],

    'setting' => [
        'model' => [
            'model' => \Litepie\Setting\Models\Setting::class,
            'table' => 'settings',
            'hidden' => [],
            'visible' => [],
            'guarded' => ['*'],
            'slugs' => ['slug' => 'name'],
            'dates' => ['deleted_at', 'created_at', 'updated_at'],
            'appends' => [],
            'fillable' => ['key', 'package', 'module', 'name', 'value', 'file', 'control', 'type', 'user_id', 'user_type'],
            'translatables' => [],
            'upload_folder' => 'setting/setting',
            'casts' => [
                'main.company.logo' => 'array',
            ],
            'revision' => [],
            'perPage' => '20',
            'search' => [
                'name' => 'like',
                'status',
            ],
        ],

        'list' => [],

        'form' => [
            [
                "key" => 'name',
                "setting" => [
                    'type' => 'env',
                    'key' => 'APP_NAME',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.name',
                "placeholder" => 'setting::setting.placeholder.name',
                "rules" => '',
                "group" => "main.general.main",
                "section" => "main",
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
                "key" => 'date.format',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.dateformat',
                ],
                "element" => 'select',
                "type" => 'select',
                "label" => 'setting::setting.label.dateformat',
                "placeholder" => 'setting::setting.placeholder.dateformat',
                'options' => function () {
                    return trans('setting::setting.options.dateformat');
                },
                "rules" => '',
                "group" => "main.general.date",
                "section" => "main",
                "col" => "4",
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
                "key" => 'main.timeformat',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.timeformat',
                ],
                "element" => 'select',
                "type" => 'select',
                "label" => 'setting::setting.label.timeformat',
                "placeholder" => 'setting::setting.placeholder.timeformat',
                'options' => function () {
                    return trans('setting::setting.options.timeformat');
                },
                "rules" => '',
                "group" => "main.general.date",
                "section" => "main",
                "col" => "4",
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
                "key" => 'main.timezone',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.timezone',
                ],
                "element" => 'select',
                "type" => 'select',
                "label" => 'setting::setting.label.timezone',
                "placeholder" => 'setting::setting.placeholder.timezone',
                'options' => function () {
                    return DateTimeZone::listIdentifiers(DateTimeZone::ALL);
                },
                "rules" => '',
                "group" => "main.general.date",
                "section" => "main",
                "col" => "4",
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
                "key" => 'main.currency.currency',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.currency.currency',
                ],
                "element" => 'select',
                "type" => 'select',
                "label" => 'setting::setting.label.currency.currency',
                "placeholder" => 'setting::setting.placeholder.currency.currency',
                'options' => function () {
                    return trans('setting::setting.options.currency.currency');
                },
                "rules" => '',
                "group" => "main.general.currency",
                "section" => "currency",
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
                "key" => 'main.currency.position',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.currency.position',
                ],
                "element" => 'select',
                "type" => 'select',
                "label" => 'setting::setting.label.currency.position',
                "placeholder" => 'setting::setting.placeholder.currency.position',
                'options' => function () {
                    return trans('setting::setting.options.currency.position');
                },
                "rules" => '',
                "group" => "main.general.currency",
                "section" => "currency",
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
                "key" => 'main.currency.thousandseperator',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.currency.thousandseperator',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.currency.thousandseperator',
                "placeholder" => 'setting::setting.placeholder.currency.thousandseperator',
                "rules" => '',
                "group" => "main.general.currency",
                "section" => "currency",
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
                "key" => 'main.currency.decimalseperator',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.currency.decimalseperator',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.currency.decimalseperator',
                "placeholder" => 'setting::setting.placeholder.currency.decimalseperator',
                "rules" => '',
                "group" => "main.general.currency",
                "section" => "currency",
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
                "key" => 'main.company.logo',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.logo',
                ],
                "element" => 'file',
                "type" => 'image',
                "label" => 'setting::setting.label.company.logo',
                "placeholder" => 'setting::setting.placeholder.company.logo',
                "rules" => '',
                "url" => function () {
                    return guard_url('/upload/setting.setting.model/logo/file');
                },
                "group" => "main.company.logo",
                "section" => "logo",
                "col" => "4",
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
                "key" => 'main.company.name',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.name',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.name',
                "placeholder" => 'setting::setting.placeholder.company.name',
                "rules" => '',
                "group" => "main.company.contact",
                "section" => "contact",
                "col" => "4",
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
                "key" => 'main.company.email',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.email',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.email',
                "placeholder" => 'setting::setting.placeholder.company.email',
                "rules" => '',
                "group" => "main.company.contact",
                "section" => "contact",
                "col" => "4",
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
                "key" => 'main.company.phone',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.phone',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.phone',
                "placeholder" => 'setting::setting.placeholder.company.phone',
                "rules" => '',
                "group" => "main.company.contact",
                "section" => "contact",
                "col" => "4",
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
                "key" => 'main.company.address',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.address',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.address',
                "placeholder" => 'setting::setting.placeholder.company.address',
                "rules" => '',
                "group" => "main.company.contact",
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
                "key" => 'main.company.city',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.city',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.city',
                "placeholder" => 'setting::setting.placeholder.company.city',
                "rules" => '',
                "group" => "main.company.contact",
                "section" => "address",
                "col" => "4",
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
                "key" => 'main.company.state',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.state',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.state',
                "placeholder" => 'setting::setting.placeholder.company.state',
                "rules" => '',
                "group" => "main.company.contact",
                "section" => "address",
                "col" => "4",
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
                "key" => 'main.company.country',
                "setting" => [
                    'type' => 'setting',
                    'key' => 'main.company.country',
                ],
                "element" => 'text',
                "type" => 'text',
                "label" => 'setting::setting.label.company.country',
                "placeholder" => 'setting::setting.placeholder.company.country',
                "rules" => '',
                "group" => "main.company.address",
                "section" => "address",
                "col" => "4",
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
                'url' => 'setting/setting/main',
                'method' => 'GET',
            ],
            'store' => [
                'url' => 'setting/setting',
                'method' => 'POST',
            ],
            'update' => [
                'url' => 'setting/setting',
                'method' => 'PUT',
            ],
            'list' => [
                'url' => 'setting/setting',
                'method' => 'GET',
            ],
        ],
        'order' => [],

        'groups' => [
            [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "setting::setting.title.main",
                'group' => "main",
                'title' => "setting::setting.title.main",
            ],
            [
                'icon' => "mdi:account-supervisor-outline",
                'name' => "setting::setting.title.general",
                'group' => "main.general",
                'title' => "setting::setting.title.general",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.company",
                'group' => "main.company",
                'title' => "setting::setting.title.company",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.integration",
                'group' => "integration",
                'title' => "setting::setting.title.integration",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.social",
                'group' => "integration.social",
                'title' => "setting::setting.title.social",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.payment",
                'group' => "integration.payment",
                'title' => "setting::setting.title.payment",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.email",
                'group' => "integration.email",
                'title' => "setting::setting.title.email",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.sms",
                'group' => "integration.sms",
                'title' => "setting::setting.title.sms",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.chat",
                'group' => "integration.chat",
                'title' => "setting::setting.title.chat",
            ],
            [
                'icon' => "fe:home",
                'name' => "setting::setting.title.google",
                'group' => "integration.google",
                'title' => "setting::setting.title.google",
            ],
        ],

        'controller' => [],
    ],

];
