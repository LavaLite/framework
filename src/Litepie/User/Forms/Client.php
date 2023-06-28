<?php

namespace Litepie\User\Forms;

use Litepie\Form\FormInterpreter;

class Client extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('user.client.urls');

        self::$search = config('user.client.search');

        self::$orderBy = config('user.client.order');

        self::$groups =  config('user.client.groups');

        self::$list =  config('user.client.list');

        self::$fields = config('user.client.form');

        return new static();
    }
}
