<?php
namespace Litepie\Theme;

use Illuminate\Filesystem\Filesystem;
use Illuminate\View\FileViewFinder;
use InvalidArgumentException;
use Theme;

class ThemeViewFinder extends FileViewFinder
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

        $this->prependNamespace($namespace, public_path(Theme::path() . '/views/vendor/' . $namespace));

        return $this->findInPaths($view, $this->hints[$namespace]);
    }

    /**
     * Find the given view in the list of paths.
     *
     * @param  string  $name
     * @param  array   $paths
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function findInPaths($name, $paths)
    {
        $location = public_path(Theme::path() . '/views');
        array_unshift($paths, $location);

        foreach ((array) $paths as $path) {

            foreach ($this->getPossibleViewFiles($name) as $file) {

                if ($this->files->exists($viewPath = $path . '/' . $file)) {
                    return $viewPath;
                }

            }

        }

        throw new InvalidArgumentException("View [$name] not found.");
    }

}
