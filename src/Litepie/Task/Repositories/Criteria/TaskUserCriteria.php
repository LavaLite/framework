<?php

namespace Litepie\Task\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria as CriteriaInterface;
use Litepie\Contracts\Repository\Repository as RepositoryInterface;

class TaskUserCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model=  $model->where('assigned_to','=', user_id('web'))->orWhere('user_id','=', user_id('web'));

        return $model;
    }
}