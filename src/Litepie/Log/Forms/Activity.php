<?php

namespace Litepie\Log\Forms;

use Litepie\Form\FormInterpreter;

class Activity extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('log.activity.urls');

        self::$search = config('log.activity.search');

        self::$orderBy = config('log.activity.order');

        self::$groups =  config('log.activity.groups');

        self::$list =  config('log.activity.list');

        self::$fields = config('log.activity.form');

        return new static();
    }
}
