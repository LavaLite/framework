<?php
namespace Litepie\Database\Traits;

trait DateFormatter
{

    /*
     * Date format to be saved in the table.
     */
    protected $dateFormatSet = 'Y-m-d H:i:s';

    /*
     * Date format to be returnd from the model.
     */
    protected $dateFormatGet = 'd M Y h:i A';

    /**
     * Boot the Trans trait for a model.
     *
     * @return void
     */
    public static function bootDateFormatter()
    {
        static::addSetterManipulator('dateformat.set', function ($model, $key, $value) {

            if ($model->checkGetSetAttribute('dates', $key)) {
                return $model->setFormatedDate($key, $value);
            }

            return $value;
        });

        static::addGetterManipulator('dateformat.get', function ($model, $key, $value) {

            if ($model->checkGetSetAttribute('dates', $key)) {
                return $model->getFormatedDate($value);
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
    public function getFormatedDate($value)
    {
        return format_date_time($value, $this->dateFormatGet);
    }

    /**
     * @param string|null $locale
     * @param bool        $withFallback
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function setFormatedDate($key, $value = null)
    {

        if (empty($value)) {
            return $this->{$key} = '';
        }

        return $this->{$key} = format_date_time($value, $this->dateFormatSet);
    }

}
