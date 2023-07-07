<?php

namespace Litepie\Form;

use Closure;
use Illuminate\Support\Arr;

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
    protected static $only = null;

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

    /**
     * Variable to store lists.
     *
     * @var array
     */
    public static $lists;

    /**
     * Variable to store actions.
     *
     * @var array
     */
    public static $actions;

    /**
     * Set the only property to filter the form elements.
     *
     * @param  string|null  $only
     * @return static
     */
    public static function only($only = null)
    {
        self::$only = $only;
        return new static();
    }

    /**
     * Get the translated lists.
     *
     * @return array
     */
    public static function lists()
    {
        $lists = collect(self::$lists)->map(function ($val) {
            $val['label'] = trans($val['label']);
            return $val;
        })->groupBy('group');

        if (empty(Self::$only)) {
            return $lists->toArray();
        }


        if (isset($lists[Self::$only])) {
            return collect($lists[Self::$only])->toArray();
        }
        return [];
    }

    /**
     * Get the translated fields.
     *
     * @return array
     */
    public static function fields()
    {
        $fields = collect(self::$fields)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            if (isset($val['options']) && is_callable($val['options']) && $val['options'] instanceof Closure) {
                $val['options'] = call_user_func($val['options']);
            }
            return $val;
        })
            ->groupBy(['group']);

        if (empty(Self::$only)) {
            return $fields->toArray();
        }
        $fields = Arr::undot($fields);
        if (isset($fields[Self::$only])) {
            return collect(Arr::dot($fields[Self::$only]))->toArray();
        }

        return [];
    }

    /**
     * Get the translated groups.
     *
     * @return array
     */
    public static function groups()
    {
        $groups = collect(self::$groups)->map(function ($val) {
            $val['name'] = trans($val['name']);
            $val['title'] = trans($val['title']);
            return $val;
        })->keyBy(['group']);

        foreach ($groups as $key => $group) {
            unset($groups[$key]);
            $key = str_replace('.', '.groups.', $key) . '';
            $groups[$key] = $group;
        }
        $groups = Arr::undot($groups);

        if (empty(Self::$only)) {
            return $groups;
        }

        if (isset($groups[Self::$only])) {
            if (isset($groups[Self::$only]['groups'])) {
                return $groups[Self::$only]['groups'];
            } else {
                $groups[Self::$only];
            }

        }

        return [];

    }
    /**
     * Translates the values in the $orderBy array using the trans() function.
     *
     * @return array
     */
    public static function orderBy()
    {
        foreach (self::$orderBy as $key => $val) {
            self::$orderBy[$key] = trans($val);
        }
        return self::$orderBy;
    }

    /**
     * Translates the values in the $search array using the trans() function.
     * If the 'options' key is set and is callable, it calls the function and assigns the result to the 'options' key.
     *
     * @return array
     */
    public static function search()
    {
        return collect(self::$search)->map(function ($val) {
            $val['label'] = trans($val['label']);
            $val['placeholder'] = trans($val['placeholder']);
            if (isset($val['options']) && is_callable($val['options']) && $val['options'] instanceof Closure) {
                $val['options'] = call_user_func($val['options']);
            }
            return $val;
        })->toArray();
    }

    /**
     * Translates the values in the $list array using the trans() function.
     *
     * @return array
     */
    public static function ilist()
    {
        return collect(self::$list)->map(function ($val) {
            $val['label'] = trans($val['label']);
            return $val;
        })->toArray();
    }

    /**
     * Translates the values in the $urls array using the trans() function.
     * If the 'url' key does not contain '://', it prepends the guard_url() function to the 'url' value.
     *
     * @return array
     */
    public static function urls()
    {
        return collect(self::$urls)->map(function ($val) {
            if (strpos($val['url'], '://') === false) {
                $val['url'] = guard_url($val['url']);
            }

            return $val;
        })->toArray();
    }

    /**
     * Translates the values in the $filters array using the trans() function.
     * If the 'sub_menus' key is set, it translates the 'name' values in the sub_menus array.
     *
     * @return array
     */
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

    /**
     * Filters the $actions array to only include items with 'Group' type.
     * Translates the 'label' values in the filtered array.
     * Groups the filtered array by 'group' key.
     *
     * @return array
     */
    public static function actions()
    {
        $actions = collect(self::$actions)->filter(function ($item) {
            return in_array('Group', $item['type']);
        });
        $actions = $actions->map(function ($action) {
            $action['label'] = trans($action['label']);
            return $action;
        })->groupBy('group');

        if (empty(Self::$only)) {
            return $actions->toArray();
        }
        if (isset($actions[Self::$only])) {
            return collect($actions[Self::$only])->toArray();
        }

        return [];

    }

    /**
     * Returns an array containing all the translated values from the different arrays in the class.
     *
     * @return array
     */
    public static function toArray()
    {
        return [
            'urls' => self::urls(),
            'list' => self::ilist(),
            'search' => self::search(),
            'orderBy' => self::orderBy(),
            'filters' => self::filters(),

            'groups' => self::groups(),
            'fields' => self::fields(),
            'actions' => self::actions(),
            'lists' => self::lists(),
        ];
    }
}
