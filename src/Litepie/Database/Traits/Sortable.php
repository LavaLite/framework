<?php

namespace Litepie\Database\Traits;

use Exception;

/**
 * Sorter model trait.
 */
trait Sortable
{
    /**
     * @var variable to store sort order column name.
     *
     * protected $sort_order = [];
     */
    protected $sort_order = 'sort_order';

    /**
     * Boot the Sorter trait for this model.
     *
     * @return void
     */
    public static function bootSorter()
    {
        static::created(function ($model) {
            $model->setSorterOrder($model->id);
        });
    }

    /**
     * Sets the sort order of records to the specified orders. If the orders is
     * undefined, the record identifier is used.
     */
    public function setSorterOrder($itemIds, $itemOrders = null)
    {
        if (!is_array($itemIds)) {
            $itemIds = [$itemIds];
        }

        if ($itemOrders === null) {
            $itemOrders = $itemIds;
        }

        if (count($itemIds) != count($itemOrders)) {
            throw new Exception('Invalid setSorterOrder call - count of itemIds do not match count of itemOrders');
        }

        foreach ($itemIds as $index => $id) {
            $order = $itemOrders[$index];
            $this->newQuery()
                ->where('id', $id)
                ->update([$this->getSortOrderColumn() => $order]);
        }
    }

    /**
     * Get the name of the "sort order" column.
     *
     * @return string
     */
    public function getSortOrderColumn()
    {
        return !empty($this->sort_order) ? $this->sort_order : 'sort_order';
    }
}
