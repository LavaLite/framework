<?php

namespace Litepie\User\Forms;

use Litepie\Form\FormInterpreter;

class User extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('user.user.urls');

        self::$search = config('user.user.search');

        self::$orderBy = config('user.user.order');

        self::$groups =  config('user.user.groups');

        self::$list =  config('user.user.list');

        self::$fields = config('user.user.form');

        return new static();
    }
}
