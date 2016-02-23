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
        \Litepie\User\Models\User::class       => \Litepie\User\Policies\UserPolicy::class,
        \Litepie\User\Models\Role::class       => \Litepie\User\Policies\RolePolicy::class,
        \Litepie\User\Models\Permission::class => \Litepie\User\Policies\PermissionPolicy::class,
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
