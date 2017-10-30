<?php
namespace Litepie\Roles\Providers;

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
// Bind Permission policy
        \Litepie\Roles\Models\Permission::class => \Litepie\Roles\Policies\PermissionPolicy::class,
// Bind Role policy
        \Litepie\Roles\Models\Role::class => \Litepie\Roles\Policies\RolePolicy::class,
    ];

    /**
     * Register any package authentication / authorization services.
     *
     * @param \Illuminate\Interfaces\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        parent::registerPolicies($gate);
    }
}
