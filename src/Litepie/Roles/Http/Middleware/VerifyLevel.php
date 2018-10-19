<?php

namespace Litepie\Roles\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Litepie\Roles\Exceptions\LevelDeniedException;

class VerifyLevel
{
    /**
     * @var \Illuminate\Interfaces\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Interfaces\Auth\Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param int                      $level
     *
     * @throws \Litepie\Roles\Exceptions\LevelDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        if ($this->auth->check() && $this->auth->user()->level() >= $level) {
            return $next($request);
        }

        throw new LevelDeniedException($level);
    }
}
