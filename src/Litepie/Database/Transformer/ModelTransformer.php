<?php

namespace Litepie\Database\Transformer;

use League\Fractal\TransformerAbstract;
use Litepie\Contracts\Database\Transformable;

/**
 * Class ModelTransformer
 * @package Litepie\Database\Transformer
 */
class ModelTransformer extends TransformerAbstract
{
    public function transform(Transformable $model)
    {
        return $model->transform();
    }
}