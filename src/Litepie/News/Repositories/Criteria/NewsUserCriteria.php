<?php

namespace Litepie\News\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria as CriteriaInterface;
use Litepie\Contracts\Repository\Repository as RepositoryInterface;

class NewsUserCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', '=', user_id())->where('user_type', '=', user_type());
        return $model;
    }
}
