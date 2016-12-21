<?php

namespace Litepie\Workflow\Exceptions;

use Exception;

class WorkflowStepNotfoundException extends Exception
{
    /**
     * Create a new inactive account exception instance.
     *
     * @param string $permission
     */
    public function __construct($message = 'Workflow step not found.', $code = 2005)
    {
        $this->message = $message;
        $this->code    = $code;
    }
}
