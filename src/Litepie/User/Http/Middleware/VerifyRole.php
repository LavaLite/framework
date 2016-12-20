<?php

namespace Litepie\User\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Litepie\User\Exceptions\InvalidAccountException;
use Litepie\User\Exceptions\RolesDeniedException;

class VerifyRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $guard = null)
    {

        if (Auth::guard($guard)->guest()) {

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }

        }

        if (user($guard)->new && config('litepie.user.verify_email')) {

            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect('verify');
            }

        }

        if (!user($guard)->active && config('litepie.user.verify_email')) {
            throw new InvalidAccountException('Account is not active.');
        }

        $roles = explode('|', $role);

        if (!user($guard)->hasRoles($roles)) {

            throw new RolesDeniedException($roles);

        }

        return $next($request);
    }

}
