<?php

namespace Litepie\Install\Helpers;

use Exception;
use Illuminate\Http\Request;
use RachidLaasri\LaravelInstaller\Helpers\EnvironmentManager as BaseEnvironmentManager;

class EnvironmentManager extends BaseEnvironmentManager
{
    /**
     * Save the form content to the .env file.
     *
     * @param Request $request
     *
     * @return string
     */
    public function saveFileWizard(Request $request)
    {
        $results = trans('install::message.environment.success');

        $envFileData = $this->getEnvContent();

        foreach (config('installer.environment.key_values') as $key => $val) {
            $envFileData = preg_replace("/\b".$key."\b.*\n/ui", "{$key}={$request->$val}\n", $envFileData);
        }

        try {
            file_put_contents($this->getEnvPath(), $envFileData);
        } catch (Exception $e) {
            $results = trans('install::message.environment.errors');
        }

        return $results;
    }
}
