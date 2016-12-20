<?php

namespace Litepie\Trans\Traits;

use App;
use Lang;

trait Translatable
{
    /**
     * @var array List of attribute names which should be translated.
     *
     * protected $translatables = [];
     */
    
    public $translatables = [];

    /**
     * Boot the Trans trait for a model.
     *
     * @return void
     */
    public static function bootTranslatable()
    {
        static::addSetterManipulator('translatables.set', function ($model, $key, $value) {
            if ($model->checkGetSetAttribute('translatables', $key)) {
                return $model->setTranslation($key, $value);
            }
            return $value;
        });

        static::addGetterManipulator('translatables.get', function ($model, $key, $value) {
            if ($model->checkGetSetAttribute('translatables', $key)) {
                return $model->getTranslation($value);
            }
            return $value;
        });
    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getTranslation($value)
    {
        $langs = $this->decodeLang($value);

        $locale = $this->locale();

        if (isset($langs[$locale])) {
            return $langs[$locale];
        }

    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function setTranslation($key, $value = null)
    {

        $locale = $this->locale();

        $langs = $this->getOriginalAttribute($key);

        $langs                  = $this->decodeLang($langs);
        $langs[$this->locale()] = $value;
        $value                  = $this->encodeLang($langs);
        return $this->{$key}    = $value;
    }

    /**
     * Alias for getTranslation().
     *
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function translate($locale = null, $withFallback = false)
    {
        return $this->getTranslation($locale, $withFallback);
    }

    /**
     * Encrypts an value.
     *
     * @param string $value Value to encrypt
     *
     * @return string Encrypted value
     */
    public function encodeLang($value)
    {
        return json_encode($value);
    }

    /**
     * Encrypts an value.
     *
     * @param string $value Value to encrypt
     *
     * @return string Encrypted value
     */
    public function decodeLang($value)
    {
        $langs = json_decode($value, true);

        if (json_last_error() == JSON_ERROR_NONE && is_array($langs)) {
            return $langs;
        }

        $trans[$this->locale()] = $value;

        return $trans;
    }

    /**
     * @return string
     */
    protected function locale()
    {
        return App::getLocale()
        ?: Lang::getLocale();
    }

}
