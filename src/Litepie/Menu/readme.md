Lavalite package that provides menu management facility for the cms.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/menu`.

    "litepie/menu": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

    Litepie\Menu\Providers\MenuServiceProvider::class,

And also add it to alias

    'Menu'  => Litepie\Menu\Facades\Menu::class,

## Publishing files and migraiting database.

**Migration and seeds**

    php artisan migrate
    php artisan db:seed --class=Litepie\\MenuTableSeeder

**Publishing configuration**

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="config"

**Publishing language**

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="lang"

**Publishing views**

    php artisan vendor:publish --provider="Litepie\Menu\Providers\MenuServiceProvider" --tag="view"


## Usage


