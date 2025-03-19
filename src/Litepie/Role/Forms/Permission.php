<?php

namespace Litepie\Role\Forms;

use Litepie\Form\FormInterpreter;

class Permission extends FormInterpreter
{
    /**
     * Sets the form and form elements.
     *
     * @return null.
     */
    public static function setAttributes()
    {
        self::$urls = config('role.permission.urls');

        self::$search = config('role.permission.search');

        self::$orderBy = config('role.permission.order');

        self::$groups = config('role.permission.groups');

        self::$list = config('role.permission.list');

        self::$fields = config('role.permission.form');

        return new static();
    }
}
