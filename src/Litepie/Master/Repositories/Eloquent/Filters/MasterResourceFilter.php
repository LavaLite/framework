<?php

namespace Litepie\Master\Repositories\Eloquent\Filters;

use Litepie\Repository\Interfaces\FilterInterface;
use Litepie\Repository\Interfaces\RepositoryInterface;

class MasterResourceFilter implements FilterInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        return $this->filterByGroup($model);
    }

    public function filterByGroup($model)
    {
        $group = request()->route('type', 'master');

        return $model->where('type', $group);
    }
}
