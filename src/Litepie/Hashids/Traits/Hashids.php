<?php

namespace Litepie\Hashids\Traits;

trait Hashids
{
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public static function findOrFail($id, $columns = ['*'])
    {
        $id = hashids_decode($id);

        return parent::findOrFail($id, $columns);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public static function findOrNew($id, $columns = ['*'])
    {
        $id = hashids_decode($id);
        $id = empty($id) ? 0 : $id;

        return parent::firstOrNew([['id', $id]]);
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
