<?php
namespace Litepie\Repository\Contracts;

use Prettus\Repository\Contracts\CriteriaInterface as PrettusCriteriaInterface; 

/**
 * Interface CriteriaInterface
 * @package Litepie\Repository\Contracts
 */
interface CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
