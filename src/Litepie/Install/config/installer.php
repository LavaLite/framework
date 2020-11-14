<?php

use Illuminate\Validation\Rule;

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
     */
    'core'                   => [
        'minPhpVersion' => '7.1.0',
    ],
    'final'                  => [
        'key'     => true,
        'publish' => false,
    ],
    'requirements'           => [
        'php'    => [
            'openssl',
            'pdo',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'fileinfo',
        ],
        'apache' => [
            'mod_rewrite',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
     */
    'permissions'            => [
        'storage/framework' => '0755',
        'storage/logs'      => '0755',
        'bootstrap/cache'   => '0755',
    ],

    /*
    |--------------------------------------------------------------------------
    | Environment Form Wizard Validation Rules & Messages
    |--------------------------------------------------------------------------
    |
    | This are the default form field validation rules. Available Rules:
    | https://laravel.com/docs/5.4/validation#available-validation-rules
    |
     */
    'environment'            => [
        'key_values' => [
            'APP_NAME'          => 'app_name',
            'APP_ENV'           => 'environment',
            'APP_DEBUG'         => 'app_debug',
            'APP_LOG_LEVEL'     => 'app_log_level',
            'APP_URL'           => 'app_url',
            'DB_CONNECTION'     => 'database_connection',
            'DB_HOST'           => 'database_hostname',
            'DB_PORT'           => 'database_port',
            'DB_DATABASE'       => 'database_name',
            'DB_USERNAME'       => 'database_username',
            'DB_PASSWORD'       => 'database_password',
            'BROADCAST_DRIVER'  => 'broadcast_driver',
            'CACHE_DRIVER'      => 'cache_driver',
            'SESSION_DRIVER'    => 'session_driver',
            'QUEUE_DRIVER'      => 'queue_driver',
            'REDIS_HOST'        => 'redis_hostname',
            'REDIS_PASSWORD'    => 'redis_password',
            'REDIS_PORT'        => 'redis_port',
            'MAIL_DRIVER'       => 'mail_driver',
            'MAIL_HOST'         => 'mail_host',
            'MAIL_PORT'         => 'mail_port',
            'MAIL_USERNAME'     => 'mail_username',
            'MAIL_PASSWORD'     => 'mail_password',
            'MAIL_ENCRYPTION'   => 'mail_encryption',
            'PUSHER_APP_ID'     => 'pusher_app_id',
            'PUSHER_APP_KEY'    => 'pusher_app_key',
            'PUSHER_APP_SECRET' => 'pusher_app_secret',
        ],

        'form'       => [
            'rules' => [
                'app_name'            => 'required|string|max:50',
                'environment'         => 'required|string|max:50',
                'environment_custom'  => 'required_if:environment,other|max:50',
                'app_debug'           => [
                    'required',
                    Rule::in(['true', 'false']),
                ],
                'app_log_level'       => 'required|string|max:50',
                'app_url'             => 'required|url',
                'database_connection' => 'required|string|max:50',
                'database_hostname'   => 'required|string|max:50',
                'database_port'       => 'required|numeric',
                'database_name'       => 'required|string|max:50',
                'database_username'   => 'required|string|max:50',
                'database_password'   => 'required|string|max:50',
                'broadcast_driver'    => 'required|string|max:50',
                'cache_driver'        => 'required|string|max:50',
                'session_driver'      => 'required|string|max:50',
                'queue_driver'        => 'required|string|max:50',
                'redis_hostname'      => 'required|string|max:50',
                'redis_password'      => 'required|string|max:50',
                'redis_port'          => 'required|numeric',
                'mail_driver'         => 'required|string|max:50',
                'mail_host'           => 'required|string|max:50',
                'mail_port'           => 'required|string|max:50',
                'mail_username'       => 'required|string|max:50',
                'mail_password'       => 'required|string|max:50',
                'mail_encryption'     => 'required|string|max:50',
                'pusher_app_id'       => 'max:50',
                'pusher_app_key'      => 'max:50',
                'pusher_app_secret'   => 'max:50',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Installed Middleware Options
    |--------------------------------------------------------------------------
    | Different available status switch configuration for the
    | canInstall middleware located in `canInstall.php`.
    |
     */
    'installed'              => [
        'redirectOptions' => [
            'route' => [
                'name' => 'welcome',
                'data' => [],
            ],
            'abort' => [
                'type' => '404',
            ],
            'dump'  => [
                'data' => 'Dumping a not found message.',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Selected Installed Middleware Option
    |--------------------------------------------------------------------------
    | The selected option fo what happens when an installer instance has been
    | Default output is to `/resources/views/error/404.blade.php` if none.
    | The available middleware options include:
    | route, abort, dump, 404, default, ''
    |
     */
    'installedAlreadyAction' => '',

    /*
    |--------------------------------------------------------------------------
    | Updater Enabled
    |--------------------------------------------------------------------------
    | Can the application run the '/update' route with the migrations.
    | The default option is set to False if none is present.
    | Boolean value
    |
     */
    'updaterEnabled'         => 'true',

];
