<?php

namespace Litepie\Database;

use Closure;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * Initialiaze page modal.
     *
     * @param $name
     */
    public function __construct(array $attributes = [])
    {
        $this->initialize();

        return parent::__construct($attributes);
    }

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
    protected static function addSetterManipulator(Closure $callback)
    {
        static::$setter_manipulators[] = $callback;
    }

    /**
     * Adds a manipulator to the setter.
     *
     * @param $callback  \Closure
     */
    public function getPublickKey()
    {
        return $this->getAttribute('slug');
    }

    /**
     * Adds a manipulator to the getter.
     *
     * @param $callback  \Closure
     */
    protected static function addGetterManipulator(Closure $callback)
    {
        static::$getter_manipulators[] = $callback;
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

    /**
     * Initialize modal variables form config.
     *
     * @param $key
     * @param $value
     */
    public function initialize()
    {
        $config = config($this->config);
        foreach ($config as $key => $val) {
            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }
        }
    }

    /**
     * Returns an array of attributes that will be used in traits.
     *
     * @return array
     */
    public function checkGetSetAttribute($variable, $field, $table)
    {
        if (!property_exists(get_called_class(), $variable) && empty($this->$variable)) {
            return false;
        }

        $array[$table] = array_flip($this->$variable);
        $array = array_dot($array);

        if (array_key_exists($table.'.'.$field, $array)) {
            return true;
        }

        return false;
    }
}
