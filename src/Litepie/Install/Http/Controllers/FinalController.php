<?php

namespace Litepie\Install\Http\Controllers;

use Litepie\Http\Controllers\PublicController;
use Litepie\Install\Helpers\UserUpdater;
use RachidLaasri\LaravelInstaller\Events\LaravelInstallerFinished;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager;
use RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager;
use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;

class FinalController extends PublicController
{
    /**
     * Update installed file and display finished view.
     *
     * @param \RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager $fileManager
     * @param \RachidLaasri\LaravelInstaller\Helpers\FinalInstallManager  $finalInstall
     * @param \RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager   $environment
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(
        InstalledFileManager $fileManager,
        FinalInstallManager $finalInstall,
        EnvironmentManager $environment,
        UserUpdater $userUpdater
    ) {
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();
        $finalUserMsg = $userUpdater->UpdateUsers();

        event(new LaravelInstallerFinished());

        return $this->response
            ->setMetaTitle(trans('install::messages.environment.menu.templateTitle'))
            ->layout('blank')
            ->view('install::finished')
            ->data(compact('finalMessages', 'finalStatusMessage', 'finalEnvFile', 'finalUserMsg'))
            ->output();
    }
}
