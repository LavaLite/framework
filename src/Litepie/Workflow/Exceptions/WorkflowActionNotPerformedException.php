<?php

namespace Litepie\Workflow\Exceptions;

use Exception;

class WorkflowActionNotPerformedException extends Exception
{
    /**
     * Create a new inactive account exception instance.
     *
     * @param string $permission
     */
    public function __construct($message = 'Workflow action can\'t be performed.', $code = 2006)
    {
        $this->message = $message;
        $this->code    = $code;
    }
}
