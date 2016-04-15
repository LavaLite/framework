<?php

namespace Litepie\User\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Litepie\User\Exceptions\InvalidAccountException;

class VerifyLogin
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param int|string               $permission
     *
     * @throws \Litepie\User\Exceptions\PermissionDeniedException
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {

        if (Auth::guard($guard)->guest()) {

            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }

        }

        if (user()->new && config('user.verify_email')) {
            return redirect('verify');
        }

        if (!user()->active) {
            throw new InvalidAccountException('Account is not active.');
        }

        return $next($request);
    }

}
