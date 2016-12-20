<?php

namespace Litepie\Page\Http\Controllers;

use App\Http\Controllers\PublicController as PublicController;

class PagePublicController extends PublicController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Page\Interfaces\PageInterface $page
     *
     * @return type
     */
    public function __construct(\Litepie\Page\Interfaces\PageRepositoryInterface $page)
    {
        $this->model = $page;
        parent::__construct();
    }

    /**
     * Show page.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function getPage($slug)
    {
        // get page by slug
        $page = $this->model->getPage($slug);

        if (is_null($page)) {
            abort(404);
        }

        //Set theme variables
        $this->theme->setTitle(strip_tags($page->title));
        $this->theme->setKeywords(strip_tags($page->keyword));
        $this->theme->setDescription(strip_tags($page->description));

        // Get view
        $view = $page->view;
        $view = view()->exists('page::public.' . $view) ? $view : 'page';

        // display page
        return $this->theme->of('page::public.' . $view, compact('page'))->render();
    }

}
