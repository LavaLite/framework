<?php

namespace Litepie\Revision\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class ActivityUserCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', '=', user_id())->where('user_type', '=', user_type());
        return $model;
    }
}
