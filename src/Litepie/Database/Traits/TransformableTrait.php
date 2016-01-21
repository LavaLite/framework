<?php namespace Litepie\Database\Traits;

/**
 * Class TransformableTrait
 * @package Litepie\Database\Traits
 */
trait TransformableTrait {

    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }

}