<?php

namespace Litepie\Repository\Contracts;

/**
 * Interface CriteriaInterface.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
interface CriteriaInterface
{
    /**
     * Apply criteria in query repository.
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
