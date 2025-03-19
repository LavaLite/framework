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
        $id = !empty($id) ? $id : 0;

        return parent::withTrashed()->find($id, $columns) ?: new static();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public static function findOrNew($id, $columns = ['*'])
    {
        $id = hashids_decode($id);
        $id = !empty($id) ? $id : 0;

        return parent::withTrashed()->find($id, $columns) ?: new static();
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

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getEidAttribute()
    {
        return hashids_encode($this->getKey());
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getSignedId($expiry = 0)
    {
        if (!empty($expiry)) {
            $expiry = strtotime($expiry);
        }
        $salt = preg_replace('/[^0-9]/', '', config('app.key'));

        return hashids_encode([$this->getKey(), $salt, $expiry]);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public static function findBySignedId($signedId, $columns = ['*'])
    {
        $signedId = hashids_decode($signedId);

        $salt = preg_replace('/[^0-9]/', '', config('app.key'));
        if ($salt != $signedId[1]) {
            return new static();
        }
        if ($signedId[2] != 0 && $signedId[2] < strtotime('now')) {
            return new static();
        }

        return parent::withTrashed()->find($signedId[0], $columns) ?: new static();
    }
}
