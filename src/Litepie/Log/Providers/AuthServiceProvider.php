<?php

namespace Litepie\Log\Providers;

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
        // Bind Action policy
        \Litepie\Log\Models\Action::class 
        => \Litepie\Log\Policies\ActionPolicy::class,// Bind Activity policy
        \Litepie\Log\Models\Activity::class 
        => \Litepie\Log\Policies\ActivityPolicy::class,
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
