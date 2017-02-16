<?php

namespace Litepie\Revision\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RevisionItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Revision\Models\Revision $news)
    {
        return [
            'id'                => $revision->id, 
            'user_type'         => $revision->user_type, 
            'user_id'           => $revision->user_id, 
            'field'             => $revision->field, 
            'cast'              => $revision->cast, 
            'old_value'         => $revision->old_value, 
            'new_value'         => $revision->new_value, 
            'revision_type'     => $revision->revision_type, 
            'revision_id'       => $revision->revision_id, 
            'created_at'        => $news->created_at->format('d M Y'),
            'updated_at'        => $news->updated_at->format('d M Y'),
        ];
    }
}