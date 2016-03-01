<?php

namespace Litepie\Trans\Traits;

use App;

trait Trans
{
    /**
      * @var array List of attribute names which should be translated.
      *
      * protected $translate = [];
      */
     protected $translate = [];

    /**
     * Boot the Trans trait for a model.
     *
     * @return void
     */
    public static function bootTrans()
    {
        static::addSetterManipulator(function ($model, $key, $value) {
            if ($model->checkGetSetAttribute('translate', $key, $model->table)) {
                return $model->setTranslation($key, $value);
            }

            return $value;
        });

        static::addGetterManipulator(function ($model, $key, $value) {
            if ($model->checkGetSetAttribute('translate', $key, $model->table)) {
                return $model->getTranslation($value);
            }

            return $value;
        });
    }

    /**
     * Returns a collection of fields that will be encrypted.
     *
     * @return array
     */
    public function getTransAttributes()
    {
        if (property_exists(get_called_class(), 'translate')) {
            $array[$this->table] = array_flip($this->translate);

            return array_dot($array);
        }

        return [];
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

        $langs = $this->decodeLang($langs);
        $langs[$this->locale()] = $value;
        $value = $this->encodeLang($langs);

        return $this->{$key} = $value;
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
