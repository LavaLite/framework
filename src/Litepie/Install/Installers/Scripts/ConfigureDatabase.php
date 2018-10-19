<?php

namespace Litepie\Install\Installers\Scripts;

use Exception;
use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;
use Litepie\Install\Installers\Writers\EnvFileWriter;

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
        $this->env = $env;
    }

    /**
     * @var Command
     */
    protected $command;

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function fire(Command $command)
    {
        $this->command = $command;

        $connected = false;

        while (!$connected) {
            $host = $this->askDatabaseHost();
            $username = $this->askDatabaseUsername();
            $password = $this->askDatabasePassword();
            $database = $this->askDatabaseName();

            if ($this->databaseConnectionIsValid($host, $username, $password, $database)) {
                config(['database.connections.mysql.host' => $host]);
                config(['database.connections.mysql.username' => $username]);
                config(['database.connections.mysql.password' => $password]);
                config(['database.connections.mysql.database' => $database]);
                $connected = true;
            } else {
                $command->error('Please ensure your database credentials are valid.');
            }
        }

        $this->env->write($database, $username, $password, $host);
        $command->info('Database successfully configured.');
    }

    /**
     * @return string
     */
    protected function askDatabaseHost()
    {
        $host = $this->command->ask('Enter your database host.', '127.0.0.1');

        return $host;
    }

    /**
     * @return string
     */
    protected function askDatabaseName()
    {
        $database = $this->command->ask('Enter your database name.', 'homestead');

        return $database;
    }

    /**
     * @param
     *
     * @return string
     */
    protected function askDatabaseUsername()
    {
        $username = $this->command->ask('Enter your database username.', 'homestead');

        return $username;
    }

    /**
     * @param
     *
     * @return string
     */
    protected function askDatabasePassword()
    {
        $databasePassword = $this->command->secret('Enter your database password (type blank for no password).', 'blank');

        return ($databasePassword === 'blank') ? '' : $databasePassword;
    }

    /**
     * Is the database connection valid?
     *
     * @return bool
     */
    protected function databaseConnectionIsValid($host, $username, $password, $database)
    {
        try {
            $link = @mysqli_connect($host, $username, $password, $database);

            if (!$link) {
                return false;
            }

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
