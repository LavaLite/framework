<?php

namespace Litepie\Menu\Repositories\Presenter;

use Litepie\Contracts\Database\Repository;
use Litepie\Contracts\Database\Criteria;

class UserCriteria implements Criteria {

    public function apply($model, Repository $repository)
    {
        $model = $model->where('user_id','=', \Auth::user()->id );
        return $model;
    }
}