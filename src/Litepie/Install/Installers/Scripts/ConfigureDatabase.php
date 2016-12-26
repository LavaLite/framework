<?php
namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;
use Litepie\Install\Installers\Writers\EnvFileWriter;
use Exception;

class ConfigureDatabase implements SetupScript
{
    /**
     * @var
     */
    protected $config;

    /**
     * @var EnvFileWriter
     */
    protected $env;

    /**
     * @param Config        $config
     * @param EnvFileWriter $env
     */
    public function __construct(EnvFileWriter $env)
    {
        $this->env    = $env;
    }

    /**
     * @var Command
     */
    protected $command;

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $this->command = $command;

        $connected = false;

        while (!$connected) {
            $host     = $this->askDatabaseHost();
            $user     = $this->askDatabaseUsername();
            $password = $this->askDatabasePassword();
            $name     = $this->askDatabaseName();

            if ($this->databaseConnectionIsValid($host, $user, $password, $name)) {
                $connected = true;
            } else {
                $command->error("Please ensure your database credentials are valid.");
            }

        }

        $this->env->write($name, $user, $password, $host);
        $command->info('Database successfully configured');
    }

    /**
     * @return string
     */
    protected function askDatabaseHost()
    {
        $host = $this->command->ask('Enter your database host', '127.0.0.1');

        return $host;
    }

    /**
     * @return string
     */
    protected function askDatabaseName()
    {

        $name = $this->command->ask('Enter your database name', 'homestead');
        return $name;
    }

    /**
     * @param
     * @return string
     */
    protected function askDatabaseUsername()
    {

        $user = $this->command->ask('Enter your database username', 'homestead');
        return $user;
    }

    /**
     * @param
     * @return string
     */
    protected function askDatabasePassword()
    {
        $databasePassword = $this->command->secret('Enter your database password (type blank for no password)', 'blank');

        return ($databasePassword === 'blank') ? '' : $databasePassword;
    }

    /**
     * Is the database connection valid?
     * @return bool
     */
    protected function databaseConnectionIsValid($host, $user, $password, $name)
    {
        try {
            $link = @mysqli_connect($host, $user, $password, $name);

            if (!$link) {
                return false;
            }
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

}
