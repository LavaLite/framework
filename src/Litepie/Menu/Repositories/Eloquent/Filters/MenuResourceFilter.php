<?php

namespace Litepie\Menu\Repositories\Eloquent\Filters;

use Illuminate\Support\Facades\Auth;
use Litepie\Repository\Interfaces\FilterInterface;
use Litepie\Repository\Interfaces\RepositoryInterface;

class MenuResourceFilter implements FilterInterface
{
    public function onlyShowDeletedForAdmins($model)
    {
        // if (Auth::user()->isAdmin()) {
        //     return $model->withTrashed();
        // }
        return $model;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        return $this->onlyShowDeletedForAdmins($model);
    }
}
