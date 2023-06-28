<?php

namespace Litepie\Log\Forms;

use Litepie\Form\FormInterpreter;

class Action extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('log.action.urls');

        self::$search = config('log.action.search');

        self::$orderBy = config('log.action.order');

        self::$groups =  config('log.action.groups');

        self::$list =  config('log.action.list');

        self::$fields = config('log.action.form');

        return new static();
    }
}
