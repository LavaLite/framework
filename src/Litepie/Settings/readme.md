Lavalite package that provides settings management facility for the cms.

## Installation

Begin by installing this package through Composer. Edit your project's `composer.json` file to require `litepie/settings`.

    "litepie/settings": "dev-master"

Next, update Composer from the Terminal:

    composer update

Once this operation completes execute below cammnds in command line to finalize installation.

    Litepie\Settings\Providers\SettingsServiceProvider::class,

And also add it to alias

    'Settings'  => Litepie\Settings\Facades\Settings::class,

## Publishing files and migraiting database.

**Migration and seeds**

    php artisan migrate
    php artisan db:seed --class=Litepie\\SettingsTableSeeder

**Publishing configuration**

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="config"

**Publishing language**

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="lang"

**Publishing views**

    php artisan vendor:publish --provider="Litepie\Settings\Providers\SettingsServiceProvider" --tag="view"


## Usage


