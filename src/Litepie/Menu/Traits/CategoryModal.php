<?php
namespace Litepie\Menu\Traits;

trait CategoryModal
{

    protected $parent_id = 'parent_id';

    /**
     * Initialize modal varables.
     */
    public function parent()
    {
        return $this->belongsTo(get_class($this), $this->getParentId());
    }

    /**
     * Initialize modal varables.
     */
    public function children()
    {
        return $this->belongsTo(get_class($this), $this->getParentId());
    }

    /**
     * Get the parent id key name.
     *
     * @return  string
     */
    public function getParentId()
    {
        return $this->parent_id;
    }
}