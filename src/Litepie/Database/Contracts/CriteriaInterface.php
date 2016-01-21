<?php
namespace Litepie\Database\Contracts;

/**
 * Interface CriteriaInterface
 * @package Litepie\Database\Contracts
 */
interface CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param $model
     * @param RepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);

}