<?php

namespace Litepie\Blog\Providers;

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
        // Bind Blog policy
        \Litepie\Blog\Models\Blog::class => \Litepie\Blog\Policies\BlogPolicy::class,
// Bind BlogCategory policy
        \Litepie\Blog\Models\BlogCategory::class => \Litepie\Blog\Policies\BlogCategoryPolicy::class,
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
