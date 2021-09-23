<?php

namespace Litepie\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @var store response object
     */
    public $response;

    /**
     * Unset guard and trans route elements.
     *
     * @var method
     *
     * @return void
     */
    public function callAction($method, $parameters)
    {
        unset($parameters['guard']);
        unset($parameters['trans']);

        return parent::callAction($method, $parameters);
    }
}
