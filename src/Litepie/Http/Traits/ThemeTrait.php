<?php

namespace Litepie\Http\Traits;

use Theme as BaseTheme;

trait ThemeTrait
{
    /**
     * @var Theme for the request.
     */
    public $theme = null;

    /**
     * @var Theme layout for the request.
     */
    protected $layout = null;

    /**
     * @var Store the page title.
     */
    protected $title = null;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function title($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @param set the $theme
     *
     * @return self
     */
    public function theme($theme)
    {
        $this->theme = BaseTheme::uses($theme);

        return $this;
    }

    /**
     * @return get the current $theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param Theme for the request $layout
     *
     * @return self
     */
    public function layout($layout)
    {
        $this->theme->layout($layout);

        return $this;
    }

    /**
     * @return Theme for the request
     */
    public function getLayout()
    {
        return $this->layout;
    }
}
