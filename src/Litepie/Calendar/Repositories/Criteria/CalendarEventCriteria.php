<?php

namespace Litepie\Calendar\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class CalendarEventCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('status','=', 'Draft');
         
    }
}