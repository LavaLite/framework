<?php

namespace Lavalite\Package\Repositories\Criteria;

use Litepie\Contracts\Repository\Criteria as CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class TeamPublicCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status', '=', 'Published');

        return $model;
    }
}
