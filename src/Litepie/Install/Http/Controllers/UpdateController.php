<?php

namespace Litepie\Install\Http\Controllers;

use Litepie\Http\Controllers\PublicController;
use Litepie\Install\Helpers\MigrationsHelper;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;

class UpdateController extends PublicController
{
    use MigrationsHelper;

    /**
     * Display the updater welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function welcome()
    {
        return $this->response
            ->setMetaTitle(trans('install::messages.updater.welcome.title'))
            ->layout('blank')
            ->view('install::update.welcome')
            ->output();
    }

    /**
     * Display the updater overview page.
     *
     * @return \Illuminate\View\View
     */
    public function overview()
    {
        $migrations = $this->getMigrations();
        $dbMigrations = $this->getExecutedMigrations();

        return $this->response
            ->setMetaTitle(trans('install::messages.updater.welcome.title'))
            ->layout('blank')
            ->view('install::update.overview')
            ->data(['numberOfUpdatesPending' => count($migrations) - count($dbMigrations)])
            ->output();
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $databaseManager = new DatabaseManager();
        $response = $databaseManager->migrateAndSeed();

        return redirect()->route('LaravelUpdater::final')
            ->with(['message' => $response]);
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     *
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $fileManager->update();

        return $this->response
            ->setMetaTitle(trans('install::messages.updater.final.title'))
            ->layout('blank')
            ->view('install::update.finished')
            ->output();
    }
}
