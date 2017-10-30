<?php namespace Litepie\Repository\Traits;

/**
 * Class TransformableTrait
 * @package Litepie\Repository\Traits
 */
trait TransformableTrait
{

    /**
     * @return array
     */
    public function transform()
    {
        return $this->toArray();
    }
}
