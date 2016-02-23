<?php

namespace Litepie\User\Repositories\Criteria;

use Litepie\Contracts\Database\Criteria;
use Litepie\Contracts\Database\Repository;

class UserCriteria implements Criteria
{
    public function apply($model, Repository $repository)
    {
        $model = $model->where('user_id', '=', user_id());

        return $model;
    }
}
