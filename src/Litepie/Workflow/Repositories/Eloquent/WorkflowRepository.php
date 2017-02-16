<?php

namespace Litepie\Workflow\Repositories\Eloquent;

use Litepie\Workflow\Interfaces\WorkflowRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class WorkflowRepository extends BaseRepository implements WorkflowRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.workflow.workflow.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.workflow.workflow.model');
    }
}
