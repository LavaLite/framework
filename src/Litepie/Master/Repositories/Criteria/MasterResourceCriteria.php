<?php

namespace Litepie\Master\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class MasterResourceCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        if (request()->master == null) {
            return $model
                ->orderBy('id', 'DESC')
                ->orderBy('order', 'DESC')
                ->where('type', 'default');
        } else {
            return $model->orderBy('id', 'DESC')
                ->where('type', request()->master);
        }
    }
}
