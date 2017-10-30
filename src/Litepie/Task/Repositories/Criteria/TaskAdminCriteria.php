<?php

namespace Litepie\Task\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class TaskAdminCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model=  $model->where('assigned_to','=', user_id('admin.web'))->orWhere('user_id','=', user_id('admin.web'));
        return $model;
    }
}