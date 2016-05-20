<?php

namespace Litepie\Contracts\Repository;

/**
 *  Criteria.
 */
interface Criteria//extends CriteriaInterface

{
    /**
     * Apply criteria in query repository.
     *
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply($model, Repository $repository);
}
