<?php

namespace Litepie\Blog\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class BlogCategoryItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Blog\Models\BlogCategory $blog_category)
    {
        return [
            'id'                => $blog_category->getRouteKey(),
            'name'              => $blog_category->name,
            'status'            => $blog_category->status,
            'user_type'         => $blog_category->user_type,
            'status'            => $blog_category->status,
            'created_at'        => format_date($blog_category->created_at),
            'updated_at'        => format_date($blog_category->updated_at),
        ];
    }
}