<?php

namespace Litepie\Database\Transformer;

use League\Fractal\TransformerAbstract;
use Litepie\Contracts\Database\Transformable;

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
