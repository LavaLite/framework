<?php

namespace Litepie\Repository\Traits;

/**
 * Class TransformableTrait.
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
