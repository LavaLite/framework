<?php
namespace Litepie\Contracts\Database;

/**
 *  Criteria
 * @package Litepie\Contracts\Database
 */
interface Criteria
{
    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository);

}