<?php

namespace Litepie\Contracts\Workflow;

interface Workflow
{

    /**
     * Determine if the given action should be granted for the current user.
     *
     * @param  string  $action
     * @param  array|mixed  $arguments
     * @return bool
     */
    public function validate($action, $arguments);

    /**
     * Get a policy instance for a given class.
     *
     * @param  object|string  $class
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function getValidatorFor($class);

}
