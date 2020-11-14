<?php

namespace Litepie\Theme;

use Litepie\Theme\Exceptions\UnknownThemeException;
Use Theme;

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

        $this->response
            ->theme($theme)
            ->layout($layout);
    }

    /**
     * Return current theme based on the route guard.
     *
     * @return string
     */
    protected function getTheme()
    {
        $this->theme = config('theme.themes.' . $this->getViewFolder() . '.theme', 'default');
        if(!Theme::exists($this->theme)) {
            throw new UnknownThemeException("Unknown theme {$this->theme}", 505);
        }
        return $this->theme;
    }

    /**
     * Return layout for the current theme you can override
     * his function in the derived controller idf required.
     *
     * @return string
     */
    protected function getLayout()
    {
        return $this->layout ?: 'default';
    }

    /**
     * Return folder for current guard.
     *
     * @return type
     */
    protected function getViewFolder()
    {
        return substr(guard(), 0, strpos(guard(), '.'));
    }
}
