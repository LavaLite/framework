<?php
namespace Litepie\Workflow\Notify;

use InvalidArgumentException;

trait Notifier
{
    /**
     * All of the defined notifiers.
     *
     * @var array
     */
    protected $notifiers = [];

    /**
     * Define a notify class for a given class type.
     *
     * @param  string  $class
     * @param  string  $notify
     * @return $this
     */
    public function notifier($class, $notify)
    {
        $this->notifiers[$class] = $notify;

        return $this;
    }

    /**
     * Determine if the given action should be granted for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $argument
     * @return bool
     */
    public function notify($action, $argument)
    {
        try {
            $result = $this->rawNotifier($action, $argument);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return $result;
    }

    /**
     * Get the raw result for the given action for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $argument
     * @return mixed
     */
    protected function rawNotifier($action, $argument)
    {

        $instance = $this->getNotifierFor($argument);

        if (!is_callable([$instance, $action])) {
            return true;
        }

        return $instance->{$action}($argument);
    }

    /**
     * Get a notify instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getNotifierFor($class)
    {

        if (is_object($class)) {
            $class = get_class($class);
        }

        if (!isset($this->notifiers[$class])) {
            throw new InvalidArgumentException("Notifier not defined for [{$class}].");
        }

        return $this->resolveNotifier($this->notifiers[$class]);
    }

    /**
     * Build a notify class instance of the given type.
     *
     * @param  object|string  $class
     * @return mixed
     */
    public function resolveNotifier($class)
    {
        return $this->container->make($class);
    }

}
