<?php

namespace Litepie\Team\Forms;

use Litepie\Form\FormInterpreter;

class Team extends FormInterpreter
{

    /**
     * Sets the form and form elements.
     * @return null.
     */
    public static function setAttributes()
    {

        self::$urls = config('team.team.urls');

        self::$search = config('team.team.search');

        self::$orderBy = config('team.team.order');

        self::$groups =  config('team.team.groups');

        self::$list =  config('team.team.list');

        self::$fields = config('team.team.form');

        self::$filters = config('team.team.filters');

        self::$lists = config('team.team.lists');

        return new static();
    }
}
