<?php

namespace Litepie\Theme\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Adapter\Local as LocalAdapter;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\MountManager;
use Theme;

class ThemePublishCommand extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The provider to publish.
     *
     * @var string
     */
    protected $provider = null;

    /**
     * The view to publish.
     *
     * @var string
     */
    protected $view = null;

    /**
     * The theme to publish.
     *
     * @var string
     */
    protected $theme = null;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'theme:publish {--force : Overwrite any existing files.}
                    {--provider= : The service provider that has the views you want to publish.}
                    {--view= : The name of the view folder you want to publish.}
                    {--theme= : The name of the theme to which you want to publish the views.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish any views to a specific theme';

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->determineWhatShouldBePublished();
        $from = $this->folderFrom();
        $to = $this->folderTo();
        $this->publishDirectory($from, $to);

        $this->info('Publishing complete.');
    }

    /**
     * Determine the provider or tag(s) to publish.
     *
     * @return void
     */
    protected function determineWhatShouldBePublished()
    {
        $this->provider = $this->option('provider');
        $this->view = $this->option('view');
        $this->theme = $this->option('theme');

        if (!$this->provider) {
            $this->promptForProvider();
        }

        if (!$this->view) {
            $this->promptForView();
        }

        if (!$this->theme) {
            $this->promptForTheme();
        }
    }

    /**
     * Prompt for which provider to publish.
     *
     * @return void
     */
    protected function promptForProvider()
    {
        $choice = $this->choice(
            "Which provider's files would you like to publish?",
            $choices = $this->providerChoice()
        );

        if (is_null($choice)) {
            $this->error('Please select one provider.');
            $this->promptForProvider();
        }

        $this->provider = $this->parseChoice($choice);

        $views = $this->viewChoice();

        if (is_null($views)) {
            $this->error("This service provider don't have any views to publish.\nPlease choose another service provider.");
            $this->provider = null;
            $this->promptForProvider();
        }
    }

    /**
     * The choices available via the prompt.
     *
     * @return array
     */
    protected function providerChoice()
    {
        return array_merge(
            preg_filter('/^/', '<comment>Provider: </comment>', Arr::sort(ServiceProvider::publishableProviders()))
        );
    }

    /**
     * Parse the answer that was given via the prompt.
     *
     * @param string $choice
     *
     * @return void
     */
    protected function parseChoice($choice)
    {
        list($type, $value) = explode(': ', strip_tags($choice));

        return $value;
    }

    /**
     * Prompt for which provider to publish.
     *
     * @return void
     */
    protected function promptForTheme()
    {
        $choice = $this->choice(
            'Into which theme the files to be published?',
            $choices = $this->themeChoice()
        );

        if (is_null($choice)) {
            $this->promptForTheme();
        }

        $this->theme = $this->parseChoice($choice);
    }

    /**
     * The choices available via the prompt.
     *
     * @return array
     */
    protected function themeChoice()
    {
        return array_merge(
            preg_filter('/^/', '<comment>Theme: </comment>', Arr::sort(Theme::themes()))
        );
    }

    /**
     * Prompt for which provider to publish.
     *
     * @return void
     */
    protected function promptForView()
    {
        $choices = $this->viewChoice();

        $choice = $this->choice(
            'Which view folder you wish to publish?',
            $choices
        );

        if (is_null($choice)) {
            $this->promptForView();
        }

        $this->view = $this->parseChoice($choice);
    }

    /**
     * The choices available via the prompt.
     *
     * @return array
     */
    protected function viewChoice()
    {
        $folder = key($this->pathsToView());

        if (is_null($folder)) {
            return;
        }

        $folders = $this->files->directories($folder);

        foreach ($folders as &$value) {
            $value = basename($value);
        }

        return array_merge(
            preg_filter('/^/', '<comment>View: </comment>', Arr::sort($folders))
        );
    }

    /**
     * Get all of the paths to publish.
     *
     * @param string $tag
     *
     * @return array
     */
    protected function pathsToView()
    {
        if (!in_array($this->provider, ServiceProvider::publishableProviders())) {
            $this->error("Service provider [{$this->provider}] is invalid!");
            $this->promptForProvider();
        }

        return ServiceProvider::pathsToPublish(
            $this->provider,
            'view'
        );
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $this->info($from.'>'.$to);

        if (!$this->files->isDirectory($from)) {
            return $this->error("Can't locate path: <{$from}>");
        }

        $this->moveManagedFiles(new MountManager([
            'from' => new Flysystem(new LocalAdapter($from)),
            'to'   => new Flysystem(new LocalAdapter($to)),
        ]));

        $this->status($from, $to, 'Directory');
    }

    /**
     * Move all the files in the given MountManager.
     *
     * @param \League\Flysystem\MountManager $manager
     *
     * @return void
     */
    protected function moveManagedFiles($manager)
    {
        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (!$manager->has('to://'.$file['path']) || $this->option('force'))) {
                $manager->put('to://'.$file['path'], $manager->read('from://'.$file['path']));
            }
        }
    }

    /**
     * Write a status message to the console.
     *
     * @param string $from
     * @param string $to
     * @param string $type
     *
     * @return void
     */
    protected function status($from, $to, $type)
    {
        $from = str_replace(base_path(), '', realpath($from));

        $to = str_replace(base_path(), '', realpath($to));

        $this->line('<info>Copied '.$type.'</info> <comment>['.$from.']</comment> <info>To</info> <comment>['.$to.']</comment>');
    }

    /**
     * Return the full path to folder from which files to be copied.
     *
     * @return string
     */
    protected function folderFrom()
    {
        return key($this->pathsToView()).'/'.$this->view;
    }

    /**
     * Return the full path to folder from which files to be copied.
     *
     * @return string
     */
    protected function folderTo()
    {
        $view = array_values($this->pathsToView());
        $view = current($view);
        $folder = basename($view);

        return  public_path(config('theme.themeDir')).'/'.$this->theme.'/views/vendor/'.$folder;
    }
}
