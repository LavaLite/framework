<?php

namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;

class PublishTheme implements SetupScript
{
    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {

        if ($command->option('verbose')) {
            $command->blockMessage('Themes', 'Publishing theme files ...', 'comment');
        }

        if ($command->option('verbose')) {
            $command->call('vendor:publish', ['--provider'=>'Litepie\Theme\ThemeServiceProvider', '--tag' => 'themes']);
            return;
        }

        $command->callSilent('vendor:publish', ['--provider'=>'Litepie\Theme\ThemeServiceProvider', '--tag' => 'themes']);
    }

}
