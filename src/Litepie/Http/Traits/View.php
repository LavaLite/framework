<?php

namespace Litepie\http\Traits;

trait View
{

    /**
     * Hint path delimiter value.
     *
     * @var string
     */
    private $HINT_PATH_DELIMITER = '::';

    /**
     * @var  View for the response.
     */
    protected $view = null;

    /**
     * @var  View for the response.
     */
    protected $includeFolder = false;

    /**
     * @var  View for the response.
     */
    protected $defaultFolder = '';

    /**
     * @return  View for the request
     */
    public function getView()
    {

        if ($this->includeFolder) {

            $view = $this->viewWithFolder();

            if (view()->exists($view)) {
                return $view;
            }

            return $this->defaultView();

        }

        return $this->view;
    }

    /**
     * @param  view for the request $view
     *
     * @return self
     */
    public function addFolder($include = true)
    {
        $this->includeFolder = $include;

        return $this;
    }

    /**
     * @param  view for the request $view
     *
     * @return self
     */
    public function view($view, $includeFolder = null)
    {

        if (is_bool($includeFolder)) {
            $this->includeFolder = $includeFolder;
        }

        $this->view = $view;

        return $this;
    }

    /**
     * Return view for the current guard.
     *
     * @return string
     *
     */
    protected function viewWithFolder()
    {

        $folder = $this->getViewFolder();

        if (!$this->hasHintInformation($this->view)) {
            return $folder . '.' . $this->view;
        }

        $segments = $this->parseNamespaceSegments($this->view);

        return $segments[0] . '::' . $folder . '.' . $segments[1];
    }

    /**
     * Return folder for current guard.
     *
     * @return type
     *
     */
    private function getViewFolder()
    {
        $guard = substr($this->getGuard(), 0, strpos(getenv('guard'), '.'));
        return config("theme.themes." . $guard . ".view", config('theme.themes.default.view', $guard));
    }

    /**
     * Return default folder for current guard.
     *
     * @return type
     *
     */
    private function getDefaultFolder()
    {
        $guard = substr($this->getGuard(), 0, strpos(getenv('guard'), '.'));
        return config("theme.themes." . $guard . ".default", config('theme.themes.default.default', 'default'));
    }

    /**
     * Return default view for current guard.
     *
     * @return type
     *
     */
    public function defaultview($folder)
    {

        $folder = $this->getDefaultFolder();

        if (!$this->hasHintInformation($this->view)) {
            return $folder . '.' . $this->view;
        }

        $segments = $this->parseNamespaceSegments($this->view);

        return $segments[0] . '::' . $folder . '.' . $segments[1];
    }

    /**
     * Returns whether or not the view name has any hint information.
     *
     * @param  string  $name
     * @return bool
     */
    private function hasHintInformation($name)
    {
        return strpos($name, $this->HINT_PATH_DELIMITER) > 0;
    }

    /**
     * Get the segments of a template with a named path.
     *
     * @param  string  $name
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    private function parseNamespaceSegments($name)
    {
        $segments = explode($this->HINT_PATH_DELIMITER, $name);

        if (count($segments) != 2) {
            throw new InvalidArgumentException("View [$name] has an invalid name.");
        }

        return $segments;
    }

}
