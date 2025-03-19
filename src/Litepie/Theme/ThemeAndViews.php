<?php

namespace Litepie\Theme;

trait ThemeAndViews
{
    /*
     * Store theme
     */
    public static $theme;

    /*
     * Store layout
     */
    public static $layout;

    /* Setup theme for the controller.
     *
     */
    public static function setTheme($theme = null, $layout = null)
    {
        if (empty($theme)) {
            $theme = static::getTheme();
        }

        if (empty($layout)) {
            $layout = static::getLayout();
        }

        static::$response
            ->theme($theme)
            ->layout($layout);
    }

    /**
     * Return current theme based on the route guard.
     *
     * @return string
     */
    protected static function getTheme()
    {
        return config(
            'theme.themes.'.static::getViewFolder().'.theme',
            config('theme.themes.default.theme')
        );
    }

    /**
     * Return layout for the current theme you can override
     * his function in the derived controller idf required.
     *
     * @return string
     */
    protected static function getLayout()
    {
        return static::$layout ?: 'default';
    }

    /**
     * Return folder for current guard.
     *
     * @return type
     */
    protected static function getViewFolder()
    {
        return substr(guard(), 0, strpos(guard(), '.'));
    }
}
