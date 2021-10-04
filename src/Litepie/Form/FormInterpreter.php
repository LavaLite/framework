<?php

namespace Litepie\Form;

/**
 * Base class to store all form elements.
 */
abstract class FormInterpreter
{
    /**
     * Variable to store form elements.
     *
     * @var array
     */
    public static $form = [];

    /**
     * Variable to store form elements.
     *
     * @var array
     */
    public static $groups;

    /**
     * Variable to store form elements.
     *
     * @var array
     */
    public static $urls;

    /**
     * Variable to store list items.
     *
     * @var array
     */
    public static $list;

    /**
     * Variable to store form configuration.
     *
     * @var array
     */
    public static $search;

    /**
     * Variable to store form configuration.
     *
     * @var array
     */
    public static $orderBy;

    /**
     * Variable to store form configuration.
     *
     * @var array
     */
    public static $fields;

    public static function fields()
    {
        $item = collect(self::$fields);

        return $item->groupBy(['group'], true);
    }

    public static function groups()
    {
        return self::$groups;
    }

    public static function orderBy()
    {
        return self::$orderBy;
    }

    public static function search()
    {
        return self::$search;
    }

    public static function list()
    {
        return self::$list;
    }

    public static function urls()
    {
        return self::$urls;
    }

    public static function toArray()
    {
        return [
            'urls'   => self::urls(),
            'list'   => self::list(),
            'search' => self::search(),
            'groups' => self::groups(),
            'orderBy' => self::orderBy(),
            'fields' => self::fields()->toArray(),
        ];
    }
}
