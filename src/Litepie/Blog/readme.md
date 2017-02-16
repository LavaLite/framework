This is a Laravel 5 package that provides blog management facility for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/blog`.

    "litepie/blog": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Blog\Providers\BlogServiceProvider::class,

```

And also add it to alias

```php
'Blog'  => Litepie\Blog\Facades\Blog::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="lang"

Views public and admin

    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="view-public"
    php artisan vendor:publish --provider="Litepie\Blog\Providers\BlogServiceProvider" --tag="view-admin"

Publish admin views only if it is necessary.

## Usage


