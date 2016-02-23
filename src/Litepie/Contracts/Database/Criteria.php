<?php

namespace Litepie\Contracts\Database;

/**
 *  Criteria.
 */
interface Criteria
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
