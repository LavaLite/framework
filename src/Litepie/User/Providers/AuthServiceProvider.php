<?php

namespace Litepie\User\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the package.
     *
     * @var array
     */
    protected $policies = [
        // Bind User policy
        \App\User::class => \Litepie\User\Policies\UserPolicy::class,
// Bind Permission policy
        \Litepie\User\Models\Permission::class => \Litepie\User\Policies\PermissionPolicy::class,
// Bind Role policy
        \Litepie\User\Models\Role::class => \Litepie\User\Policies\RolePolicy::class,
// Bind Team policy
        \Litepie\User\Models\Team::class => \Litepie\User\Policies\TeamPolicy::class,
    ];

    /**
     * Register any package authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
