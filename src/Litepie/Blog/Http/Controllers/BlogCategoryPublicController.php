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
     * @param type \Litepie\BlogCategory\Interfaces\BlogCategoryRepositoryInterface $category
     *
     * @return type
     */
    public function __construct(BlogCategoryRepositoryInterface $category)
    {
        $this->repository = $category;
        parent::__construct();
    }

    /**
     * Show category's list.
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

        return $this->theme->of('blog::public.category.index', compact('blog_categories'))->render();
    }

    /**
     * Show category.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $category = $this->repository->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('blog::public.category.show', compact('category'))->render();
    }

}
