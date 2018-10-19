<?php

namespace Litepie\Trans;

use Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined;
use Mcamara\LaravelLocalization\LaravelLocalization;

class Trans extends LaravelLocalization
{
    /**
     * Return an array of all supported Locales.
     *
     * @param bool $excludeCurrent
     *
     * @throws SupportedLocalesNotDefined
     *
     * @return array
     */
    public function getSupportedLocales($excludeCurrent = false)
    {
        if (empty($this->supportedLocales)) {
            $this->supportedLocales = $this->configRepository->get('trans.supportedLocales');
        }
        if (empty($this->supportedLocales) || !is_array($this->supportedLocales)) {
            throw new SupportedLocalesNotDefined();
        }
        if ($excludeCurrent) {
            $locales = $this->supportedLocales;
            unset($locales[$this->currentLocale]);

            return $locales;
        }

        return $this->supportedLocales;
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

    /**
     * Returns the translation key for a given path.
     *
     * @return bool Returns value of useAcceptLanguageHeader in config.
     */
    protected function useAcceptLanguageHeader()
    {
        return $this->configRepository->get('trans.useAcceptLanguageHeader');
    }

    /**
     * Return an array of all supported Locales but in the order the user
     * has specified in the config file. Useful for the language selector.
     *
     * @return array
     */
    public function getLocalesOrder()
    {
        $locales = $this->getSupportedLocales();

        $order = $this->configRepository->get('trans.localesOrder');

        uksort($locales, function ($a, $b) use ($order) {
            $pos_a = array_search($a, $order);
            $pos_b = array_search($b, $order);

            return $pos_a - $pos_b;
        });

        return $locales;
    }
}
