<?php

namespace Litepie\Task\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria as CriteriaInterface;
use Litepie\Contracts\Repository\Repository as RepositoryInterface;

class TaskAdminCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model=  $model->where('assigned_to','=', user_id('admin.web'))->orWhere('user_id','=', user_id('admin.web'));
        return $model;
    }
}