<?php

namespace Litepie\Hashids\Traits;

use Illuminate\Contracts\Encryption\DecryptException;

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
            $eid = \Hashids::decode($eid)[0];
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
        return \Hashids::encode($this->getOriginal($this->getKeyName()));
    }

}
