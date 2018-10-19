<?php

namespace Litepie\Roles\Providers;

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
        'Litepie\Roles\Models\Role' => \Litepie\Roles\Policies\RolePolicy::class,
// Bind Permission policy
        'Litepie\Roles\Models\Permission' => \Litepie\Roles\Policies\PermissionPolicy::class,
    ];

    /**
     * Register any package authentication / authorization services.
     *
     * @param \Illuminate\Contracts\Auth\Access\Gate $gate
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
