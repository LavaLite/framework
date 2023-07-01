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

    /**
     * Variable to filter field variables.
     *
     * @var array
     */
    public static $filters;

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
            if (isset($val['options']) && is_callable($val['options'])) {
                $val['options'] = call_user_func($val['options']);
            }
            return $val;
        });

        if (!self::$grouped) {
            return $item;
        }

        if (self::$grouped === true || self::$grouped == 1) {
            return $item->groupBy(['group'], true);
        }

        if (self::$grouped == 2) {
            return $item->groupBy(['group', 'section'], true);
        }

    }

    public static function groups()
    {
        foreach (self::$groups as $key => $val) {
            self::$groups[$key]['name'] = trans($val['name']);
            self::$groups[$key]['title'] = trans($val['title']);
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

    public static function filters()
    {
        return collect(self::$filters)->map(function ($val) {
            $val['name'] = trans($val['name']);
            if (isset($val['sub_menus'])) {
                foreach ($val['sub_menus'] as $key => $menu) {
                    $val['sub_menus'][$key]['name'] = trans($menu['name']);
                }
            }
            return $val;
        })->toArray();
    }

    public static function toArray()
    {
        return [
            'urls' => static::urls(),
            'list' => static::list(),
            'search' => static::search(),
            'orderBy' => static::orderBy(),

            'groups' => static::groups(),
            'fields' => static::fields()->toArray(),
            'filters' => self::filters(),

        ];
    }
}
