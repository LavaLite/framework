<?php

namespace Litepie\Install\Helpers;

use Illuminate\Support\Facades\DB;

trait MigrationsHelper
{
    /**
     * Get the migrations in /database/migrations.
     *
     * @return array Array of migrations name, empty if no migrations are existing
     */
    public function getMigrations()
    {
        return array_keys(app('migrator')->getMigrationFiles(app('migrator')->paths()));
    }

    /**
     * Get the migrations that have already been ran.
     *
     * @return Illuminate\Support\Collection List of migrations
     */
    public function getExecutedMigrations()
    {
        // migrations table should exist, if not, user will receive an error.
        return DB::table('migrations')->get()->pluck('migration');
    }
}
