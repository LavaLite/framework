This is a Litepie 5 package that provides block management facility for litepie framework.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/block`.

    "litepie/block": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

```php
Litepie\Block\Providers\BlockServiceProvider::class,

```

And also add it to alias

```php
'Block'  => Litepie\Block\Facades\Block::class,
```

Use the below commands for publishing

Migration and seeds

    php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="migrations"
    php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="seeds"

Configuration

    php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="config"

Language

    php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="lang"

Views files

    php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="view"

Public folders
   
	php artisan vendor:publish --provider="Litepie\Block\Providers\BlockServiceProvider" --tag="public"


## Usage


