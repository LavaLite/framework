<?php

namespace Litepie\Repository\Transformer;

use League\Fractal\TransformerAbstract;
use Litepie\Contracts\Repository\Transformable;

/**
 * Class ModelTransformer.
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}
