This is a Laravel 5 package that provides menu interface for lavalite framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `lavalite/menu`.

    "lavalite/menu": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes, the final step is to add the service provider and menu alias. Open `app/config/app.php`, and add a new item to the providers array.

```php
'Litepie\Menu\MenuServiceProvider'
```

And also add it to alias

```php
'Menu'  => 'Litepie\Menu\Facades\Menu',
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="migrate"
    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="config"

Views

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="view-menu"
    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="view-admin"


You are done!

## Usage

On the view page just call
```php
{{Menu::menu('key-of-the-root-menu')}}
```

Menu Configuration


