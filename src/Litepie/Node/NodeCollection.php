<?php

namespace Litepie\Node;

use Illuminate\Database\Eloquent\Collection as CollectionBase;
use Request;

/**
 * Custom collection used by NestedNode trait.
 *
 * General access methods:
 *
 *   $collection->toNested(); // Converts collection to an eager loaded one.
 */
class NodeCollection extends CollectionBase
{
    /**
     * Converts a flat collection of nested set models to an set where
     * children is eager loaded.
     *
     * @param bool $removeOrphans Remove nodes that exist without their parents.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function toNested($removeOrphans = true, $rootKey = null)
    {
        /*
         * Set new collection for "children" relations
         */
        $collection = $this->getDictionary();

        foreach ($collection as $key => $model) {
            $model->setRelation('children', new CollectionBase());
        }

        /*
         * Assign all child nodes to their parents
         */
        $nestedKeys = [];

        foreach ($collection as $key => $model) {
            if (!$parentKey = $model->getParentId()) {
                continue;
            }

            if (array_key_exists($parentKey, $collection)) {
                $collection[$parentKey]->children[] = $model;
                $nestedKeys[] = $model->getKey();
            } elseif ($removeOrphans) {
                $nestedKeys[] = $model->getKey();
            }
        }

        /*
         * Remove processed nodes
         */
        foreach ($nestedKeys as $key) {
            unset($collection[$key]);
        }

        return new CollectionBase($collection);
    }

    /**
     * Gets an array with values of a given column. Values are indented according to their depth.
     *
     * @param string $value  Array values
     * @param string $key    Array keys
     * @param string $indent Character to indent depth
     *
     * @return array
     */
    public function listsNested($value, $key = null, $indent = '   ')
    {
        /*
         * Recursive helper function
         */
        $buildCollection = function ($items, $depth = 0) use (&$buildCollection, $value, $key, $indent) {
            $result = [];

            $indentString = str_repeat($indent, $depth);

            foreach ($items as $item) {
                if ($key !== null) {
                    $result[$item->{$key}

                    ] = $indentString.$item->{$value};
                } else {
                    $result[] = $indentString.$item->{$value};
                }

                /*
                 * Add the children
                 */
                $childItems = $item->getChildren();

                if ($childItems->count() > 0) {
                    if ($key === null) {
                        $result = array_merge($result, $buildCollection($childItems, $depth + 1));
                    } else {
                        $result = $result + $buildCollection($childItems, $depth + 1);
                    }
                }
            }

            return $result;
        };

        /*
         * Build a nested collection
         */
        $rootItems = $this->toNested();
        $result = $buildCollection($rootItems);

        return $result;
    }

    /**
     * Gets an array with values of a given column. Values are indented according to their depth.
     *
     * @param string $value  Array values
     * @param string $key    Array keys
     * @param string $indent Character to indent depth
     *
     * @return array
     */
    public function toMenu($menu_key)
    {
        /*
         * Set new collection for "children" relations
         */
        $collection = collect($this->getDictionary());
        $menu = null;

        foreach ($collection as $item) {
            if ($item->url == Request::path()) {
                $menu = $item;
                break;
            }
        }

        foreach ($collection as $key => $model) {
            $model->active = '';
            $model->setRelation('children', new CollectionBase());
        }

        if ($menu) {
            $menu_id = $menu->id;

            while ($menu_id) {
                $collection[$menu_id]->active = 'active';
                $menu_id = $collection[$menu_id]->getParentId();
            }
        }

        /*
         * Assign all child nodes to their parents
         */
        $nestedKeys = [];

        foreach ($collection as $key => $model) {
            if (!$parentKey = $model->getParentId()) {
                continue;
            }

            if ($collection->get($parentKey)) {
                $collection[$parentKey]->children[] = $model;
                $nestedKeys[] = $model->getKey();
            } else {
                $nestedKeys[] = $model->getKey();
            }
        }

        return new CollectionBase($collection->where('key', $menu_key)->first()->getChildren());
    }
}
