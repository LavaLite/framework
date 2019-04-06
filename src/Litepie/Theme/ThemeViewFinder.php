<?php

namespace Litepie\Theme;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder;
use Illuminate\View\ViewFinderInterface;
use InvalidArgumentException;
use Theme;

class ThemeViewFinder extends FileViewFinder implements ViewFinderInterface
{
    public function __construct(Filesystem $files, array $paths, array $extensions = null)
    {
        parent::__construct($files, $paths, $extensions);
    }

    /*
     * Override findNamespacedView() to add "theme/view/vendor/..." paths
     *
     * @param  string  $name
     * @return string
     */
    protected function findNamespacedView($name)
    {
        // Extract the $view and the $namespace parts
        list($namespace, $view) = $this->parseNamespaceSegments($name);

        // Add possible view folders based of the route
        if (count($this->hints[$namespace]) < 3) {
            $hintPath = $this->hints[$namespace][0];
            $resoPath = resource_path('views/vendor/').$namespace;
            $themPath = public_path(app('theme')->path().'/views/vendor/'.$namespace);
            $defaFolder = $this->getDefaultFolder();
            $viewFolder = $this->getViewFolder();
            $this->prependNamespace($namespace, $hintPath.'/'.$defaFolder);
            $this->prependNamespace($namespace, $hintPath.'/'.$viewFolder);
            $this->prependNamespace($namespace, $resoPath);
            $this->prependNamespace($namespace, $resoPath.'/'.$defaFolder);
            $this->prependNamespace($namespace, $resoPath.'/'.$viewFolder);
            $this->prependNamespace($namespace, $themPath);
        }

        return $this->findInPaths($view, $this->hints[$namespace]);
    }

    /**
     * Find the given view in the list of paths.
     *
     * @param string $name
     * @param array  $paths
     *
     * @throws \InvalidArgumentException
     *
     * @return string
     */
    protected function findInPaths($name, $paths)
    {
        $location = public_path(app('theme')->path().'/views');
        array_unshift($paths, $location);
        foreach ((array) $paths as $path) {
            if (!$this->files->exists($path)) {
                continue;
            }

            foreach ($this->getPossibleViewFiles($name) as $file) {
                if ($this->files->exists($viewPath = $path.'/'.$file)) {
                    return $viewPath;
                }
            }
        }

        throw new InvalidArgumentException("View [$name] not found.");
    }

    /**
     * Return folder for current guard.
     *
     * @return type
     */
    private function getViewFolder()
    {
        $guard = substr(guard(), 0, strpos(guard(), '.'));

        return config('theme.themes.'.$guard.'.view', config('theme.themes.default.view', $guard));
    }

    /**
     * Return default folder for current guard.
     *
     * @return type
     */
    private function getDefaultFolder()
    {
        $guard = substr(guard(), 0, strpos(guard(), '.'));

        return config('theme.themes.'.$guard.'.default', config('theme.themes.default.default', 'default'));
    }
}
