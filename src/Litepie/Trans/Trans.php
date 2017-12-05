<?php

namespace Litepie\Trans;

use Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined;
use Mcamara\LaravelLocalization\LaravelLocalization;

class Trans extends LaravelLocalization
{

    /**
     * Return an array of all supported Locales.
     *
     * @throws SupportedLocalesNotDefined
     *
     * @return array
     */
    public function getSupportedLocales()
    {

        if (!empty($this->supportedLocales)) {
            return $this->supportedLocales;
        }

        $locales = $this->configRepository->get('trans.locales');

        if (empty($locales) || !is_array($locales)) {
            throw new SupportedLocalesNotDefined();
        }

        $this->supportedLocales = $locales;

        return $locales;
    }

    /**
     * Returns an URL adapted to $locale or current locale.
     *
     * @param string      $url    URL to adapt. If not passed, the current url would be taken.
     * @param string|bool $locale Trans to adapt, false to remove locale
     *
     * @throws UnsupportedTransException
     *
     * @return string URL translated
     */
    public function to($url = null, $locale = null)
    {

        if (starts_with($url, 'http')) {
            return url($url);
        }

        return $this->getLocalizedURL($locale, $url);
    }

    /**
     * Returns the translation key for a given path.
     *
     * @return bool Returns value of hideDefaultTransInURL in config.
     */
    public function hideDefaultLocaleInURL()
    {
        return config('trans.hideDefaultLocaleInURL');
    }

}
