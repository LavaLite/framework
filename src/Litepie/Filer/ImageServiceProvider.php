<?php

namespace Litepie\Filer;

use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;

class ImageServiceProvider extends ServiceProvider
{
    /**
     * Determines if Intervention Imagecache is installed.
     *
     * @return bool
     */
    private function cacheIsInstalled()
    {
        return class_exists('Intervention\\Image\\ImageCache');
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // setup intervention/imagecache if package is installed
        $this->cacheIsInstalled() ? $this->bootstrapImageCache() : null;
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // create image
        $app->singleton('image', function ($app) {
            return new ImageManager($app['config']->get('image'));
        });

        $app->alias('image', 'Intervention\Image\ImageManager');
    }

    /**
     * Bootstrap imagecache.
     *
     * @return void
     */
    private function bootstrapImageCache()
    {
        $app = $this->app;

        // imagecache route
        if (is_string(config('image.route'))) {
            $filename_pattern = '[ \w\\.\\/\\-\\@\(\)]+';

            // route to access template applied image file
            $app['router']->get(config('image.route').'/{template}/{filename}', [
                'uses' => 'Litepie\Filer\ImageCacheController@getResponse',
                'as'   => 'imagecache',
            ])->where(['filename' => $filename_pattern]);
        }
    }
}
