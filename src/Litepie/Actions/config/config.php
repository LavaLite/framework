<?php

return [

    /*
     * If set to false, no activities will be saved to the database.
     */
    'enabled' => env('ACTION_LOGGER_ENABLED', true),

    /*
     * When the clean-command is executed, all recording activities older than
     * the number of days specified here will be deleted.
     */
    'delete_records_older_than_days' => 90,

    /*
     * If no log name is passed to the activity() helper
     * we use this default log name.
     */
    'default_log_name' => 'default',

    /*
     * You can specify an auth driver here that gets user models.
     * If this is null we'll use the default Laravel auth driver.
     */
    'default_auth_driver' => null,

    /*
     * This model will be used to log action. The only requirement is that
     * it should be or extend the Lavalit\Activities\Models\Activity model.
     */
    'action_model' => \Litepie\Actions\Models\Action::class,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the Action model shipped with this package.
     */
    'action_table_name' => 'log_actions',
];
