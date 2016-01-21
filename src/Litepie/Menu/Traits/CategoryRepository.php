<?php

namespace Litepie\Menu\Traits;

trait CategoryRepository
{

    /**
     * Initialize modal varables.
     */
    public function parent($id)
    {
        return $this->model->with('parent')->find($id)->parent();
    }

    /**
     * Initialize modal varables.
     */
    public function children($id)
    {
        return $this->model->find($id)->children();
    }

    /**
     * Initialize modal varables.
     */
    public function siblings($id)
    {
        $node =  $this->model->find($id);
        return $this->model->whereParentId($node -> parent_id)->get();
    }

    /**
     * Initialize modal varables.
     */
    public function tree($id)
    {

    }

    /**
     * Initialize modal varables.
     */
    public function breadcrumb()
    {

    }

    /**
     * Get the parent id key name.
     *
     * @return  string
     */
    public function getParentId()
    {
        return static::PARENT_ID;
    }
}
