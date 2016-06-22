<?php

namespace Litepie\Hashids\Traits;

trait Hashids
{

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return parent::findOrFail(hashids_decode($id), $columns);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function findOrNew($id, $columns = ['*'])
    {
        return parent::findOrNew(hashids_decode($id), $columns);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return hashids_encode($this->getKey());
    }
}
