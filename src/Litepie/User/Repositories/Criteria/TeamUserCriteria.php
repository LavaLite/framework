<?php

namespace Litepie\User\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria as CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class TeamUserCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', '=', user_id());

        return $model;
    }
}
