<?php

namespace Litepie\Install\Http\Controllers;

use Artisan;
use Illuminate\Support\Str;

trait InstallCommands
{
    /**
     * @var array
     */
    protected $search = [
        'DB_HOST=127.0.0.1',
        'DB_DATABASE=homestead',
        'DB_USERNAME=homestead',
        'DB_PASSWORD=secret',
    ];

    /**
     * @var string
     */
    protected $template = '.env.example';

    /**
     * @var string
     */
    protected $file = '.env';
    /**
     * @var array
     */
    protected $packages = [
        'Block'    => \Litepie\Block\BlockServiceProvider::class,
        'Calendar' => \Litepie\Calendar\CalendarServiceProvider::class,
        'Contact'  => \Litepie\Contact\ContactServiceProvider::class,
        'Menu'     => \Litepie\Menu\MenuServiceProvider::class,
        'Message'  => \Litepie\Message\MessageServiceProvider::class,
        'News'     => \Litepie\News\NewsServiceProvider::class,
        'Page'     => \Litepie\Page\PageServiceProvider::class,
        'Settings' => \Litepie\Settings\SettingsServiceProvider::class,
        'Task'     => \Litepie\Task\TaskServiceProvider::class,
        'User'     => \Litepie\User\UserServiceProvider::class,
    ];
    /**
     * @var array
     */
    protected $model = [
        'superuser' => '\Litepie\User\Models\User',
        'admin'     => '\Litepie\User\Models\User',
        'user'      => '\Litepie\User\Models\User',
        'client'    => '\Litepie\User\Models\Client',
    ];

    /**
     * @var array
     */
    protected $tags = [
        'config', 'view', 'seeds', 'lang', 'migrations', 'public',
    ];

    /**
     * @param $name
     * @param $username
     * @param $password
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function write($finder, $name, $username, $password, $host)
    {
        $environmentFile = $finder->get(base_path($this->template));

        $replace = [
            "DB_HOST=$host",
            "DB_DATABASE=$name",
            "DB_USERNAME=$username",
            "DB_PASSWORD=$password",
        ];

        $newEnvironmentFile = str_replace($this->search, $replace, $environmentFile);

        $finder->put(base_path($this->file), $newEnvironmentFile);
    }

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function setAppKey()
    {
        Artisan::call('key:generate');
    }

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function dbMigrate()
    {
        Artisan::call('migrate:refresh');
    }

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function dbSeed()
    {
        Artisan::call('db:seed');
    }

    /**
     * Fire the install script.
     *
     * @param $tag
     *
     * @return mixed
     */
    public function publish($tag)
    {
        $package = implode(',', array_keys($this->packages));
        foreach ($this->packages as $kp => $package) {
            $this->call(['--provider' => $package, '--tag' => $tag, '--force' => true]);
        }
    }

    /**
     * Fire the install script.
     *
     * @param $command
     *
     * @return mixed
     */
    public function call($option)
    {
        Artisan::call('vendor:publish', $option);
    }

    /**
     * Fire the install script.
     *
     * @param Command $command
     *
     * @return mixed
     */
    public function setCredentials($attributes, $model)
    {
        $data['email'] = $attributes['email'];
        $data['password'] = bcrypt($attributes['password']);
        $data['api_token'] = Str::random(60);

        $user = $model::create($data);
    }
}
