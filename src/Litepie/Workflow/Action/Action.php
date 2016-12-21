<?php

namespace Litepie\Workflow\Action;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Str;
use InvalidArgumentException;

trait Action
{
    /**
     * All of the defined actions.
     *
     * @var array
     */
    protected $actions = [];

    /**
     * Define a action class for a given class type.
     *
     * @param  string  $class
     * @param  string  $action
     * @return $this
     */
    public function actions($class, $action)
    {
        $this->actions[$class] = $action;

        return $this;
    }

    /**
     * Determine if the given action should be granted for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $class
     * @return bool
     */
    public function action($action, $class)
    {
        try {
            $result = $this->rawAction($action, $class);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return $result;
    }

    /**
     * Get the raw result for the given action for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $class
     * @return mixed
     */
    protected function rawAction($action, $class)
    {

        $instance = $this->getActionFor($class);

        if (!is_callable([$instance, $action])) {
            return true;
        }

        return $instance->{$action}($class);
    }

    /**
     * Get a action instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getActionFor($class)
    {

        if (is_object($class)) {
            $class = get_class($class);
        }

        if (!isset($this->actions[$class])) {
            throw new InvalidArgumentException("Action not defined for [{$class}].");
        }

        return $this->resolveAction($this->actions[$class]);
    }

    /**
     * Build a action class instance of the given type.
     *
     * @param  object|string  $class
     * @return mixed
     */
    public function resolveAction($class)
    {
        return $this->container->make($class);
    }

}
