<?php

namespace Litepie\Contracts\Database;

use Illuminate\Support\Collection;

/**
 *  RepositoryCriteria.
 */
interface RepositoryCriteria
{
    /**
     * Push Criteria for filter the query.
     *
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * Get Collection of Criteria.
     *
     * @return Collection
     */
    public function getCriteria();

    /**
     * Find data by Criteria.
     *
     * @param Criteria $criteria
     *
     * @return mixed
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * Skip Criteria.
     *
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true);
}
