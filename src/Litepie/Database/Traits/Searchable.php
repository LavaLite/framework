<?php

namespace Litepie\Database\Traits;

/**
 * Sorter model trait.
 */
trait Searchable
{
    /**
     * @var variable to store sort order column name.
     *
     * protected $sort_order = [];
     */
    protected $search = [];

    /**
     * Sets the sort order of records to the specified orders. If the orders is
     * undefined, the record identifier is used.
     */
    public function getSearchFields()
    {
        return $this->search;
    }
}
