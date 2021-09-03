This is a Laravel 5 package that provides alerts management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/alerts`.

    "litepie/alerts": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Notification\Providers\AlertsServiceProvider::class,

```

And also add it to alias

```php
'Alerts'  => Litepie\Notification\Facades\Alerts::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Litepie\Notification\Providers\AlertsServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


