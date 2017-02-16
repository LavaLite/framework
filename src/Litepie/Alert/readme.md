This is a Laravel 5 package that provides alert management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/alert`.

    "litepie/alert": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Alert\Providers\AlertServiceProvider::class,

```

And also add it to alias

```php
'Alert'  => Litepie\Alert\Facades\Alert::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Litepie\Alert\Providers\AlertServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


