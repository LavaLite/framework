<?php

namespace Litepie\User\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Litepie\User\Exceptions\InvalidAccountException;
use Litepie\User\Exceptions\PermissionDeniedException;

class VerifyPermission
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param int|string               $permission
     *
     * @throws \Litepie\User\Exceptions\PermissionDeniedException
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $guard = null)
    {

        if (Auth::guard($guard)->check() &&
            Auth::guard($guard)->user()->can($permission)) {
            return $next($request);
        }

        if (user()->new && config('litepie.user.verify_email')) {
            return redirect('verify');
        }

        if (!user()->active) {
            throw new InvalidAccountException('Account is not active.');
        }

        throw new PermissionDeniedException($permission);
    }

}
