<?php

namespace Litepie\Repository\Transformer;

use League\Fractal\TransformerAbstract;
use Litepie\Repository\Contracts\Transformable;

/**
 * Class ModelTransformer.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}
