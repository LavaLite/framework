<?php

namespace Litepie\Workflow\Repositories\Presenter;

use League\Fractal\TransformerAbstract;
use Hashids;

class WorkflowItemTransformer extends TransformerAbstract
{
    public function transform(\Litepie\Workflow\Models\Workflow $workflow)
    {
        return [
            'id'                => $workflow->getRouteKey(),
            'workflowable_id'   => $workflow->workflowable_id,
            'workflowable_type' => $workflow->workflowable_type,
            'action'            => $workflow->action,
            'status'            => $workflow->status,
            'comment'           => $workflow->comment,
            'data'              => $workflow->data,
            'performable_id'     => $workflow->performable_id,
            'performable_type'   => $workflow->performable_type,
            'status'            => trans('app.'.$workflow->status),
            'created_at'        => format_date_time($workflow->created_at),
            'updated_at'        => format_date_time($workflow->updated_at),
        ];
    }
}