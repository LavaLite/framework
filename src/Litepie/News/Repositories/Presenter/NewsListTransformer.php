<?php

namespace Litepie\News\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class NewsListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\News\Models\News $news)
    {
        return [
            'id'                => $news->getRouteKey(),
            'title'             => $news->title,
            'description'       => $news->description,
            'images'            => $news->images,
            'status'            => trans('app.'.$news->status),
            'created_at'        => $news->created_at->format('d M Y'),
            'updated_at'        => $news->updated_at->format('d M Y'),
        ];
    }
}