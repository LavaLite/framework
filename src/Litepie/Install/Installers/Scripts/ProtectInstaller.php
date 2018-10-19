<?php

namespace Litepie\Install\Installers\Scripts;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Litepie\Install\Installers\SetupScript;

class ProtectInstaller implements SetupScript
{
    /**
     * @var Filesystem
     */
    protected $finder;

    /**
     * @param Filesystem $finder
     */
    public function __construct(Filesystem $finder)
    {
        $this->finder = $finder;
    }

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
        $currentKey = config('app.key');

        if (strlen($currentKey) !== 0) {
            $command->alert('Application In Production!');

            if (!$command->confirm('Do you really wish to continue the installation?')) {
                throw new Exception('Installation terminated.');
            }

            return;
        }
    }
}
