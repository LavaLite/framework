<?php

namespace Litepie\Block\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class BlockListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Block\Models\Block $block)
    {
        return [
            'id'          => $block->getRouteKey(),
            'category_id' => $block->category->name,
            'name'        => $block->name,
            'url'         => $block->url,
            'description' => $block->description,
            'status'      => $block->status,
            'image'       => $block->image,
            'images'      => $block->images,
            'published'    => ($block->published == 'Yes') ? 'Published' : '-',
        ];
    }
}
