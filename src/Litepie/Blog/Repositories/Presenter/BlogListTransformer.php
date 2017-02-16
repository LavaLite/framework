<?php

namespace Litepie\Blog\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class BlogListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Blog\Models\Blog $blog)
    {
        return [
            'id'                => $blog->getRouteKey(),
            'category_id'       => $blog->category->name,
            'title'             => $blog->title,
            'details'           => $blog->details,
            'images'            => $blog->images,
            'viewcount'         => $blog->viewcount,
            'status'            => $blog->status,
            'posted_on'         => $blog->posted_on,
            'user_type'         => $blog->user_type,
            'status'            => $blog->status,
            'created_at'        => format_date($blog->created_at),
            'updated_at'        => format_date($blog->updated_at),
        ];
    }
}