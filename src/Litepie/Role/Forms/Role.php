<?php

namespace Litepie\Role\Forms;

use Litepie\Form\FormInterpreter;

class Role extends FormInterpreter
{
    /**
     * Sets the form and form elements.
     *
     * @return null.
     */
    public static function setAttributes()
    {
        self::$urls = config('role.role.urls');

        self::$search = config('role.role.search');

        self::$orderBy = config('role.role.order');

        self::$groups = config('role.role.groups');

        self::$list = config('role.role.list');

        self::$fields = config('role.role.form');

        return new static();
    }
}
