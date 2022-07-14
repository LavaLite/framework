<?php

namespace Litepie\Install\Installers\Scripts;

use Exception;
use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;

class ProtectInstaller implements SetupScript
{
    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @throws Exception
     *
     * @return mixed
     */
    public function fire(Command $command)
    {
        if (config('app.env')=='production') {
            $command->alert('Application In Production!');

            if (!$command->confirm('Do you really wish to continue the installation?')) {
                throw new Exception('Installation terminated.');
            }

            return;
        }
    }
}
