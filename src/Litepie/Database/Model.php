<?php

namespace Litepie\Database;

use Closure;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Litepie\Database\Traits\AttributeManipulator;

class Model extends Eloquent
{
    use AttributeManipulator;
    /**
     * Initialiaze page modal.
     *
     * @param $name
     */
    public function __construct(array $attributes = [])
    {
        $this->initialize();

        return parent::__construct($attributes);
    }

    /**
     * Retuturn the public key value 
     */
    public function getPublicKey()
    {
        return $this->getAttribute('slug');
    }

    /**
     * Initialize modal variables form config.
     *
     * @param $key
     * @param $value
     */
    public function initialize()
    {
        $config = config($this->config);

        if (isset($config['presenter'])) {
            $this->setPresenter(new $config['presenter']);
            unset($config['presenter']);
        }

        foreach ($config as $key => $val) {

            if (property_exists(get_called_class(), $key)) {
                $this->$key = $val;
            }

        }

    }

}
