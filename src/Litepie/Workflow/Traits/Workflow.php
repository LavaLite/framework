<?php
namespace Litepie\Workflow\Traits;

/**
 * Trait HasPermission.
 */
trait Workflow
{
    
    /**
     * Workflow morph to many relation.
     */
    public function workflow()
    {
        return $this->morphTo();
    }

    /**
     * Workflow morph to many relation.
     */
    public function user()
    {
        return $this->morphTo();
    }


    /**
     * @return mixed
     */
    public function workflowHistory()
    {
        return $this->morphMany('Litepie\Workflow\Models\Workflow', 'workflowable')->orderBy('created_at', 'ASC')->take(25);
    }


}
