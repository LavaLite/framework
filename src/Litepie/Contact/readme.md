This is a Laravel 5 package that provides contact management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/contact`.

    "litepie/contact": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Contact\Providers\ContactServiceProvider::class,

```

And also add it to alias

```php
'Contact'  => Litepie\Contact\Facades\Contact::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Litepie\Contact\Providers\ContactServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


