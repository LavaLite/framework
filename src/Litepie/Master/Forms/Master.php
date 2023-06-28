<?php

namespace Litepie\Master\Forms;

use Litepie\Form\FormInterpreter;

class Master extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('master.master.urls');

        self::$search = config('master.master.search');

        self::$orderBy = config('master.master.order');

        self::$groups =  config('master.master.groups');

        self::$list =  config('master.master.list');

        self::$fields = config('master.master.form');

        return new static();
    }
}
