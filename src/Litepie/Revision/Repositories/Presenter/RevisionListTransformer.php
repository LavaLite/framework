<?php

namespace Litepie\Revision\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class RevisionListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Revision\Models\Revision $revision)
    {
        return [
            'id'                => $revision->id, 
            'user_type'         => $revision->user_type, 
            'user_id'           => @$revision->user->name, 
            'field'             => $revision->field, 
            'cast'              => $revision->cast, 
            'old_value'         => $revision->old_value, 
            'new_value'         => $revision->new_value, 
            'revision_type'     => substr(strrchr($revision->revision_type, '\\'), 1), 
            'revision_id'       => $revision->revision_id, 
            'created_at'        => $revision->created_at->format('d M Y'),
            'updated_at'        => $revision->updated_at->format('d M Y'),
            'values'            => '<a href="#" class="text-danger valueModal" data-old="'.$revision->old_value.'" data-new="'.$revision->new_value.'"><i class="fa fa-file-text"></i></a>',
        ];
    }
}