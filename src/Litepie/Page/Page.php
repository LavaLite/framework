<?php

namespace Litepie\Page;

use View;

/**
 *
 */
class Page
{
    // Page modal
    protected $model;

    /**
     * Initialize page facade.
     *
     * @param type \Litepie\Page\Interfaces\PageRepositoryInterface $page
     *
     * @return none
     */
    public function __construct(\Litepie\Page\Interfaces\PageRepositoryInterface $page)
    {
        $this->model = $page;
    }

    /**
     * Calls page repository function.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        return $this->model->$name($arguments[0]);
    }

    /**
     * @param int $perpage
     *
     * @return mixed
     */
    public function gadget($perpage = 10)
    {
        $data['pages'] = $this->model->paginate($perpage);

        return View::make('page::admin.page.gadget', $data);
    }

    /**
     * Return return field value of a page.
     *
     * @param mixed  $idslug
     * @param string $field
     *
     * @return string
     */
    public function pages($idslug, $field)
    {
        $page = $this->model->getPage($idslug);

        return $page[$field];
    }

    /**
     * Returns page object.
     *
     * @param mixed  $idslug
     * @param string $field
     *
     * @return mixed
     */
    public function page($idslug)
    {
        return  $this->model->getPage($idslug);
    }

    /**
     * Returns count of pages.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count(array $filters = null)
    {
        return  $this->model->count();
    }
}
