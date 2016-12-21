<?php
namespace Litepie\Workflow\Validate ;

use InvalidArgumentException;

trait Validator
{
    /**
     * All of the defined validators.
     *
     * @var array
     */
    protected $notifier = [];

    /**
     * Define a validator class for a given class type.
     *
     * @param  string  $class
     * @param  string  $validator
     * @return $this
     */
    public function validator($class, $validator)
    {
        $this->validators[$class] = $validator;

        return $this;
    }

    /**
     * Determine if the given action should be granted for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $argument
     * @return bool
     */
    public function validate($action, $argument)
    {
        try {
            $result = $this->rawValidate($action, $argument);
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
    protected function rawValidate($action, $argument)
    {

        $instance = $this->getValidatorFor($argument);

        if (!is_callable([$instance, $action])) {
            return true;
        }

        return $instance->{$action}

        ($argument);
    }

    /**
     * Get a validator instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getValidatorFor($class)
    {

        if (is_object($class)) {
            $class = get_class($class);
        }

        if (!isset($this->validators[$class])) {
            throw new InvalidArgumentException("Validator not defined for [{$class}].");
        }

        return $this->resolveValidator($this->validators[$class]);
    }

    /**
     * Build a validator class instance of the given type.
     *
     * @param  object|string  $class
     * @return mixed
     */
    public function resolveValidator($class)
    {
        return $this->container->make($class);
    }

}
