<?php

namespace Litepie\Notification\Forms;

use Litepie\Form\FormInterpreter;

class Notification extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('notification.notification.urls');

        self::$search = config('notification.notification.search');

        self::$orderBy = config('notification.notification.order');

        self::$groups =  config('notification.notification.groups');

        self::$list =  config('notification.notification.list');

        self::$fields = config('notification.notification.form');

        return new static();
    }
}
