<?php

namespace Litepie\Validators;

use Illuminate\Support\ServiceProvider;
use Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Load view
        Validator::extend(
            'recaptcha',
            'Litepie\\Validators\\ReCaptcha@validate'
        );
    }
}
