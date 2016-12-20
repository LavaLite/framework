<?php

namespace Litepie\Contact\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the litepie.
     *
     * @var array
     */
    protected $policies = [
        // Bind Contact policy
        \Litepie\Contact\Models\Contact::class => \Litepie\Contact\Policies\ContactPolicy::class,
    ];

    /**
     * Register any litepie authentication / authorization services.
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
