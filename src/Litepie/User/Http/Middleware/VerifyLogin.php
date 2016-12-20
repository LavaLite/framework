<?php

namespace Litepie\User\Http\Middleware;

use Closure;

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
    public function handle($request, Closure $next, $guard = null)
    {

        if (user($guard)->isNew && config('litepie.user.verify_email')) {
            return redirect('verify');
        }

        if (user($guard)->isLocked) {
            return redirect('locked');
        }

        return $next($request);
    }

}
