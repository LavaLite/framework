<?php
namespace Litepie\Install\Installers\Scripts;

use Illuminate\Console\Command;
use Litepie\Install\Installers\SetupScript;

class PackgeAssets implements SetupScript
{
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
    protected $tags = [
        'config', 'view', 'seeds', 'lang', 'migrations', 'public',
    ];

    /**
     * Fire the install script
     * @param  Command $command
     * @return mixed
     */
    public function fire(Command $command)
    {
        $this->command = $command;

        if ($this->command->option('verbose')) {
            $package = implode(',', array_keys($this->packages));
            $this->command->blockMessage('Package resources', "Publishing package resources for [$package] ...", 'comment');
        }

        foreach ($this->tags as $tag) {
            $this->command->sectionMessage(ucfirst($tag) . " files", "Publishing {$tag} files");

            if ($confirm = $this->confirm($tag)) {

                if ($confirm == 'Ask') {

                    foreach ($this->packages as $kp => $package) {

                        if (!$reConfirm = $this->reConfirm($tag, $kp)) {
                            continue;
                        }

                        $this->publish($reConfirm);
                    }

                } else {
                    $this->publish($confirm);
                }

            }

        }

    }

    public function confirm($tag)
    {
        $choice = $this->command->choice("Do you want to publish {$tag} files?", ['No', 'Yes', 'Overwrite', 'Ask'], 1);

        if ($choice == 'No') {
            return false;
        }

        if ($choice == 'Ask') {
            return $choice;
        }

        $options = ['--tag' => $tag];

        if ($choice == 'Overwrite') {
            $options['--force'] = true;
        }

        return $options;
    }

    public function reConfirm($tag, $package)
    {
        $choice = $this->command->choice("Do you want to publish \"{$tag}\" files of \"{$package}\" package?", ['No', 'Yes', 'Overwrite'], 1);

        if ($choice == 'No') {
            return false;
        }

        $options = ['--provider' => $package, '--tag' => $tag];

        if ($choice == 'Overwrite') {
            $options['--force'] = true;
        }

        return $options;
    }

    public function publish($options)
    {

        if ($this->command->option('verbose')) {
            $this->command->call('vendor:publish', $options);
            return;
        }

        $this->command->callSilent('vendor:publish', $options);
    }

}
