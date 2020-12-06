<?php

namespace Litepie\Trans\Traits;

use App;
use Lang;

trait Translatable
{
    /**
     * @var array List of attribute names which should be translated.
     *
     * protected $translatable = [];
     */
    public $translatable = [];

    /**
     * Boot the Trans trait for a model.
     *
     * @return void
     */
    public static function bootTranslatable()
    {
        /*
         * Set Translated attributes on new records
         */
        static::saving(function ($model) {
            foreach ($model->translatable as $key) {
                $model->setTranslation($key, $model->$key);
            }
        });

        /*
         * Retrive Translated attributes on new records
         */
        static::retrieved(function ($model) {
            foreach ($model->translatable as $key) {
                $model->$key = $model->getTranslation($key);
            }
        });

        /*
         * Retrive Translated attributes on new records
         */
        static::saved(function ($model) {
            foreach ($model->translatable as $key) {
                $model->$key = $model->getTranslation($key);
            }
        });
    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getTranslation($key)
    {
        $langs = $this->getOriginalAttribute($key);

        $langs = $this->decodeLang($langs);

        return @$langs[$this->locale()];
    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getTranslations()
    {
    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function setTranslation($key, $value = null)
    {
        $langs = $this->getOriginal($key);
        $langs = $this->decodeLang($langs);
        $langs[$this->locale()] = $value;
        $value = $this->encodeLang($langs);

        return $this->{$key} = $value;
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
