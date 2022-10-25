<?php

namespace Litepie\Http\Controllers;

use Litepie\Http\Response\ActionResponse;
use Litepie\User\Traits\RoutesAndGuards;

class ActionController extends Controller
{
    use RoutesAndGuards;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->setGuard();
        $this->response = app(ActionResponse::class);
        $this->middleware('auth:' . guard());
    }

}
