<?php

namespace Litepie\Menu\Forms;

use Litepie\Form\FormInterpreter;

class Menu extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('menu.menu.urls');

        self::$search = config('menu.menu.search');

        self::$orderBy = config('menu.menu.order');

        self::$groups =  config('menu.menu.groups');

        self::$list =  config('menu.menu.list');

        self::$fields = config('menu.menu.form');

        return new static();
    }
}
