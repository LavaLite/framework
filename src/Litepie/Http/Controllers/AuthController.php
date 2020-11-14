<?php

namespace Litepie\Http\Controllers;

use Litepie\Http\Response\AuthResponse;
use Litepie\Theme\ThemeAndViews;
use Litepie\User\Traits\RoutesAndGuards;

class AuthController extends Controller
{
    use RoutesAndGuards, ThemeAndViews;

    /**
     * Initialize public controller.
     *
     * @return null
     */
    public function __construct()
    {
        $this->setGuard();
        $this->response = app(ResourceResponse::class);
        $this->middleware("auth:" . guard());
        $this->layout = 'app';
        $this->setTheme();
    }

}
