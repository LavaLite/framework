<?php

namespace Litepie\User;

/*
 *
 * Part of the Litepie package.
 *
 *
 * @package    User
 * @version    5.1.0
 */

use Form;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Litepie\Roles\Interfaces\PermissionRepositoryInterface;
use Litepie\Roles\Interfaces\RoleRepositoryInterface;
use Litepie\User\Interfaces\TeamRepositoryInterface;
use Litepie\User\Interfaces\UserRepositoryInterface;

/**
 * User wrapper class.
 */
class User
{
    /**
     * @var Application variable
     */
    protected $app;

    /**
     * @var User repository variable
     */
    protected $user;

    /**
     * @var permission repository variable
     */
    protected $permission;

    /**
     * @var role repository variable
     */
    protected $role;

    /**
     *  Initialize User.
     *
     * @param \Litepie\Contracts\User\User                 $user
     * @param \Litepie\Contracts\User\Role                 $role
     * @param \Litepie\Contracts\User\PermissionRepository $permission
     */
    public function __construct(
        Application $app,
        UserRepositoryInterface $user,
        TeamRepositoryInterface $team,
        RoleRepositoryInterface $role,
        PermissionRepositoryInterface $permission
    ) {
        $this->app = $app;
        $this->user = $user;
        $this->team = $team;
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Registers a user by giving the required credentials
     * and an optional flag for whether to activate the user.
     *
     * @param array $credentials
     * @param bool  $activate
     *
     * @return \Litepie\Contracts\User\User
     */
    public function create(array $credentials, $active = false)
    {
        $credentials = $credentials + ['active' => $active];

        return $this->user->create($credentials);
    }

    /**
     * Attempts to authenticate the given user
     * according to the passed credentials.
     *
     * @param array $credentials
     * @param bool  $remember
     *
     * @return bool
     */
    public function attempt(array $credentials, $remember = false, $guard = null)
    {
        return $this->app['auth']->guard($guard)->attempt($credentials, $remember);
    }

    /**
     * Alias for authenticating with the remember flag checked.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function attemptAndRemember(array $credentials, $guard = null)
    {
        return $this->app['auth']->guard($guard)->attempt($credentials, true);
    }

    /**
     * Check to see if the user is logged in and activated, and hasn't been banned or suspended.
     *
     * @return bool
     */
    public function check($guard = null)
    {
        return $this->app['auth']->guard($guard)->check();
    }

    /**
     * Logs in the given user and sets properties
     * in the session.
     *
     * @param array $credentials
     * @param bool  $remember
     *
     * @return void
     */
    public function login(Authenticatable $user, $remember = false, $guard = null)
    {
        // Authentication attempt usng laravel native auth class
        return $this->app['auth']->guard($guard)->login($user, $remember);
    }

    /**
     * Logs in user for a single request
     * in the session.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function once(array $user, $guard = null)
    {
        return $this->app['auth']->guard($guard)->once($user);
    }

    /**
     * Logs in user for a single request
     * in the session.
     *
     * @param array $credentials
     *
     * @return bool
     */
    public function onceUsingId($user_id, $guard = null)
    {
        return $this->app['auth']->guard($guard)->onceUsingId($user_id);
    }

    /**
     * Logs the current user out.
     *
     * @return void
     */
    public function logout($guard = null)
    {
        $this->app['auth']->guard($guard)->logout();
    }

    /**
     * Returns the current user being used by Litepie, if any.
     *
     * @return Laravel user object
     */
    public function user($guard = null)
    {
        // We will lazily attempt to load our user
        return $this->app['auth']->guard($guard)->user();
    }

    /**
     * Get the current authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function getUser($guard = null)
    {
        return $this->app['auth']->guard($guard)->user();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function permissionsList()
    {
        return $this->permission->getList('name', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function rolesList()
    {
        return $this->role->pluck('name', 'id')->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function roles($guard = null)
    {
        return $this->role->pluck('name', 'id')->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function teams($guard = null)
    {
        return $this->team->pluck('name', 'id')->all();
    }

    /**
     * Returns the specific details of current user.
     *
     * @return mixed
     */
    public function users($field)
    {

        if (!is_null($this->getUser())) {
            return $this->getUser()->$field;
        }

    }

    /**
     * Return the profile update page.
     *
     * @return Response
     */
    public function profile($view, $guard = null)
    {
        $user = $this->getUser($guard);

        Form::populate($user);

        return view($view, compact('user'));
    }

    /**
     * Return the profile update page.
     *
     * @return Response
     */
    public function all()
    {
        return $this->user->all();
    }

    /**
     * Return change password form.
     *
     * @return Response
     */
    public function password($view, $guard = null)
    {
        $user = $this->getUser($guard);

        return view($view, compact('user'));
    }

    /**
     * Activate a user with given id.
     *
     * @return bool
     */
    public function activate($id)
    {
        return $this->user->activate($id);
    }

    /**
     * Set guard form the requested uri.
     *
     * @return bool
     */
    public function setRouteGuard()
    {
        $segments = request()->segments();
        $guard = array_intersect(array_keys(config('auth.guards')), $segments);

        if (!empty($guard)) {
            $guard = current($guard);
        } else {
            $guard = 'client';
        }
        $sub = in_array('api', $segments) ? 'api' : 'web';

        $this->getSetGuard("{$guard}.{$sub}");
        return $guard;

    }

    /**
     * Set guard form the requested uri.
     *
     * @return bool
     */
    public function urlPrefixGuard($url)
    {
        $guards = $this->getSetGuard() ?: config('auth.defaults.guard');
        $prefix = current(explode('.', $guards));
        return $prefix . '/' . trim($url, '/\\');
    }

    /**
     * Get or set current guard.
     *
     * @return bool
     */
    public function getSetGuard($guard = null)
    {
        if (empty($guard)) {
            $guard = getenv('guard');
            return empty($guard) ? config('auth.defaults.guard') : $guard;
        } else {
            putenv("guard={$guard}");
            app('auth')->shouldUse("{$guard}");
        }

    }

    /**
     * Return the count of records.
     *
     * @return Response
     */
    public function count()
    {
        return $this->user->count();
    }

}
