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
     * Variable determine whether to return group the form.
     *
     * @var array
     */
    protected static $grouped = true;

    /**
     * Variable to store groups.
     *
     * @var array
     */
    public static $groups;

    /**
     * Variable to store urls.
     *
     * @var array
     */
    public static $urls;

    /**
     * Variable to store list.
     *
     * @var array
     */
    public static $list;

    /**
     * Variable to store search fields.
     *
     * @var array
     */
    public static $search;

    /**
     * Variable to store sort fields
     *
     * @var array
     */
    public static $orderBy;

    /**
     * Variable to store field variables.
     *
     * @var array
     */
    public static $fields;

    public static function grouped($grouped = true)
    {
        self::$grouped = $grouped;
        return new static();
    }

    public static function fields()
    {
        $item = collect(self::$fields)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            return $val;
        });

        if (!self::$grouped) {
            return $item;
        }

        return $item->groupBy(['group'], true);
    }

    public static function groups()
    {
        foreach (self::$groups as $key => $val) {
            self::$groups[$key] = trans($val);
        }
        return self::$groups;
    }

    public static function orderBy()
    {
        foreach (self::$orderBy as $key => $val) {
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

    public static function list() {

        return collect(self::$list)->map(function ($val) {
            $val['label'] = trans($val['label']);
            return $val;
        })->toArray();
    }

    public static function urls()
    {
        return collect(self::$urls)->map(function ($val) {
            if (strpos($val['url'], '://') === false) {
                $val['url'] = guard_url($val['url']);
            }

            return $val;
        })->toArray();
    }

    public static function toArray()
    {
        return [
            'urls' => self::urls(),
            'list' => self::list(),
            'search' => self::search(),
            'orderBy' => self::orderBy(),

            'groups' => self::groups(),
            'fields' => self::fields()->toArray(),
        ];
    }
}
