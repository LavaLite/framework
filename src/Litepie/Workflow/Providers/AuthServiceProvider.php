<?php

namespace Litepie\Workflow\Providers;

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
        // Bind Workflow policy
        \Litepie\Workflow\Models\Workflow::class => \Litepie\Workflow\Policies\WorkflowPolicy::class,
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
