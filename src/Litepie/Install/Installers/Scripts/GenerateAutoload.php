<?php
namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use Litepie\Install\Installers\SetupScript;

class GenerateAutoload implements SetupScript
{
    /**
     * @var array
     */
    protected $drivers = [
        'Sentinel',
    ];

    /**
     * @var
     */
    private $application;



    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $command->blockMessage('Dump autoload', 'Generating autoload classmap...', 'comment');
        $command->call('optimize');

    }

}
