<?php

namespace Litepie\User\Repositories\Eloquent\Filters;

use Litepie\Repository\Interfaces\FilterInterface;
use Litepie\Repository\Interfaces\RepositoryInterface;

class ClientPublicFilter implements FilterInterface
{
    public function onlyPublished($model)
    {
        return $model->where('status', 'Published');
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $this->onlyPublished($model);
    }
}
