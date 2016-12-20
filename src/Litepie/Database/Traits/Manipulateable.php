<?php

namespace Larapack\AttributeManipulation;

use Closure;

trait Manipulateable
{
    /**
     * @var array List of setters to be ran
     */
    protected static $setter_manipulators = [];

    /**
     * @var array List of getters to be ran
     */
    protected static $getter_manipulators = [];

    /**
     * Adds a manipulator to the setter.
     *
     * @param $callback  \Closure
     */
    protected static function addSetterManipulator(Closure $callback, $key)
    {
        static::$setter_manipulators[$key] = $callback;
    }

    /**
     * Adds a manipulator to the getter.
     *
     * @param $callback  \Closure
     */
    protected static function addGetterManipulator(Closure $callback, $key)
    {
        static::$getter_manipulators[$key] = $callback;
    }

    /**
     * Gets an attribute value after running through the manipulators.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        foreach (static::$getter_manipulators as $manipulator) {
            $value = $manipulator($this, $key, $value);
        }

        return $value;
    }

    /**
     * Gets an attribute value without running through the manipulators.
     *
     * @param $key
     *
     * @return mixed
     */
    public function getOriginalAttribute($key)
    {
        return parent::getAttribute($key);
    }

    /**
     * Sets an attribute value after running through the manipulators.
     *
     * @param $key
     * @param $value
     */
    public function setAttribute($key, $value)
    {
        foreach (static::$setter_manipulators as $manipulator) {
            $value = $manipulator($this, $key, $value);
        }

        parent::setAttribute($key, $value);
    }

    /**
     * Sets an attribute value without running through the manipulators.
     *
     * @param $key
     * @param $value
     */
    public function setOriginalAttribute($key, $value)
    {
        parent::setAttribute($key, $value);
    }
}