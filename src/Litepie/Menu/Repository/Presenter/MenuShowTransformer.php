<?php

namespace Litepie\Menu\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class MenuShowTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Menu\Models\Menu $page)
    {
        return [
            'id'            => $page->eid,
            'slug'          => $page->slug,
            'url'           => $page->slug.'.html',
            'name'          => $page->name,
            'heading'       => $page->heading,
            'title'         => $page->title,
            'keyword'       => $page->keyword,
            'description'   => $page->description,
            'content'       => $page->content,
            'abstract'      => $page->abstract,
            'banner'        => $page->banner,
            'images'        => $page->images,
            'view'          => $page->view,
            'compiler'      => $page->compiler,
            'status'        => $page->status,
            'upload_folder' => $page->upload_folder,
            'created'       => $page->created_at,
            'order'         => $page->order,
        ];
    }
}
