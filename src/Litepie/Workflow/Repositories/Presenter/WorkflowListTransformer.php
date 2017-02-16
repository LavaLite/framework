<?php

namespace Litepie\Workflow\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class WorkflowListTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Workflow\Models\Workflow $workflow)
    {
         
        return [
            'id'                => $workflow->getRouteKey(),
            'workflowable'      => @$workflow->workflowable->title,
            'module'            => substr(strrchr($workflow->workflowable_type, '\\'), 1),
            'workflowable_id'   => $workflow->workflowable_id,
            'workflowable_type' => $workflow->workflowable_type,
            'action'            => $workflow->action,
            'status'            => $workflow->status,
            'comment'           => $workflow->comment,
            'data'              => "<a href='#' class='text-danger valueModal' data-id='".$workflow->getRouteKey()."'><input type='hidden' name='workflow-data".$workflow->getRouteKey()."' value='".json_encode($workflow->data)."'><i class='fa fa-file-text'></i></a>",
            'performable'       => @$workflow->performable->name,
            'performable_id'    => $workflow->performable_id,
            'performable_type'  => $workflow->performable_type,
            'status'            => $workflow->status,
            'created_at'        => format_date_time($workflow->created_at),
            'updated_at'        => format_date_time($workflow->updated_at),

        ];
    }
}