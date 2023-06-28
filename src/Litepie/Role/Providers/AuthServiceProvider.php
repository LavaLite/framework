<?php

namespace Litepie\Role\Providers;

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
        // Bind Role policy
        \Litepie\Role\Models\Role::class 
        => \Litepie\Role\Policies\RolePolicy::class,// Bind Permission policy
        \Litepie\Role\Models\Permission::class 
        => \Litepie\Role\Policies\PermissionPolicy::class,
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
