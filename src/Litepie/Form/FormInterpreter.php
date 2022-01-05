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
        $item = collect(self::$fields)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            return $val;
        });

        return $item->groupBy(['group'], true);
    }

    public static function groups()
    {
        foreach(self::$groups as $key => $val){
            self::$groups[$key] = trans($val);
        }
        return self::$groups;
    }

    public static function orderBy()
    {
        foreach(self::$orderBy as $key => $val){
            self::$orderBy[$key] = trans($val);
        }
        return self::$orderBy;
    }

    public static function search()
    {
        return collect(self::$search)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            return $val;
        })->toArray();
    }

    public static function  list() {

        return collect(self::$list)->map(function ($val) {
            $val['label'] = trans($val['label']);
            return $val;
        })->toArray();
    }

    public static function urls()
    {
        return collect(self::$urls)->map(function ($val) {
            if (strpos($val['url'],'://')==false)
                $val['url'] = guard_url($val['url']);
            return $val;
        })->toArray();
    }

    public static function toArray()
    {
        return [
            'urls' => self::urls(),
            'list' => self::list(),
            'search' => self::search(),
            'groups' => self::groups(),
            'orderBy' => self::orderBy(),
            'fields' => self::fields()->toArray(),
        ];
    }
}
