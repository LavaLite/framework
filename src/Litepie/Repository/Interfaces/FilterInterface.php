<?php

namespace Litepie\Repository\Interfaces;

/**
 * Interface FilterInterface.
 */
interface FilterInterface
{
    /**
     * Apply filter in query repository.
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository);
}
