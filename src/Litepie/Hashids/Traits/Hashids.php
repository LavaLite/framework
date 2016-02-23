<?php

namespace Litepie\Hashids\Traits;

trait Hashids
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getEidAttribute($value)
    {
        return $this->getRouteKey();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function findByEid($eid)
    {
        if ($eid != '0') {
            $eid = hashids_decode($eid);
        }

        return $this->findOrNew($eid);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function findOrFail($eid)
    {
        return $this->findByEid($eid);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return hashids_encode($this->getOriginal($this->getKeyName()));
    }
}
