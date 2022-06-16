<?php

namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;

class SetAppKey implements SetupScript
{
    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function fire(Command $command)
    {
        if ($command->option('verbose')) {
            $command->info('Genarating application key...');
            $command->call('key:generate', ['--force' => true]);

            return;
        }

        $command->call('key:generate', ['--force' => true]);
    }
}
