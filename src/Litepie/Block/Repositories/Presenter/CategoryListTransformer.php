<?php

namespace Litepie\Block\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CategoryListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Block\Models\Category $category)
    {
        return [
            'id'     => $category->getRouteKey(),
            'name'   => ucfirst($category->name),
            'status' => $category->status,
        ];
    }
}
