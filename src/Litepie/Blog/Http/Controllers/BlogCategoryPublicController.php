<?php

namespace Litepie\Blog\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;

class BlogCategoryPublicController extends BaseController
{
    // use BlogCategoryWorkflow;

    /**
     * Constructor.
     *
     * @param type \Litepie\BlogCategory\Interfaces\BlogCategoryRepositoryInterface $blog_category
     *
     * @return type
     */
    public function __construct(BlogCategoryRepositoryInterface $blog_category)
    {
        $this->repository = $blog_category;
        parent::__construct();
    }

    /**
     * Show blog_category's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $blog_categories = $this->repository
        ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
        ->scopeQuery(function($query){
            return $query->orderBy('id','DESC');
        })->paginate();

        return $this->theme->of('blog::public.blog_category.index', compact('blog_categories'))->render();
    }

    /**
     * Show blog_category.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $blog_category = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('blog::public.blog_category.show', compact('blog_category'))->render();
    }

}
