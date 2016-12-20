This is a Laravel 5 package that provides settings management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/settings`.

    "litepie/settings": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Settings\Providers\SettingsServiceProvider::class,

```

And also add it to alias

```php
'Settings'  => Litepie\Settings\Facades\Settings::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


