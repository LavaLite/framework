<?php

namespace Litepie\Theme;

use Theme;
use View;
trait ThemeAndViews
{
    /*
     * Store theme
     */
    public $theme;

    /*
     * Store layout
     */
    public $layout;

    /* Setup theme for the controller.
     *
     */
    public function setTheme($theme = null, $layout = null)
    {

        if (empty($theme)) {
            $theme = $this->getTheme();
        }

        if (empty($layout)) {
            $layout = $this->getLayout();
        }

        $this->response->theme($theme)
            ->layout($layout);
    }

    /**
     * Return current theme based on the route guard.
     *
     * @return string
     *
     */
    protected function getTheme()
    {
        return config("theme.themes." . $this->getViewFolder() . ".theme", config('theme.themes.default.theme'));
    }

    /**
     * Return layout for the current theme you can override
     * his function in the derived controller idf required.
     *
     * @return string
     *
     */
    protected function getLayout()
    {
        return 'default';
    }

    /**
     * Return view for the current guard.
     *
     * @return string
     *
     */
    protected function getView($view, $package = null, $theme = null, $folder = null)
    {

        if ($cview = $this->getThemeView($view, $package, $theme)) {
            return $cview;
        }

        if ($cview = $this->getPackageView($view, $package, $folder)) {
            return $cview;
        }

        return $view;
    }

    public function getThemeView($view, $package, $theme)
    {

        if (empty($theme)) {
            $theme = $this->getTheme();
        }

        if (is_null($package) && View::exists("{$theme}::{$view}")) {
            return "{$theme}::{$view}";
        }

        if (View::exists("{$theme}::{$package}.{$view}")) {
            return "{$theme}::{$package}.{$view}";
        }

        return false;
    }

    public function getPackageView($view, $package, $folder)
    {
        $newfolder = $this->getViewFolder();

        if (View::exists("{$package}::{$newfolder}.{$view}")) {
            return "{$package}::{$newfolder}.{$view}";
        }

        if (View::exists("{$package}::{$folder}.{$view}")) {
            return "{$package}::{$folder}.{$view}";
        }

        return false;
    }

    /**
     * Return folder for current guard.
     *
     * @return type
     *
     */
    protected function getViewFolder()
    {
        return substr($this->getGuard(), 0, strpos(getenv('guard'), '.'));
    }

}
