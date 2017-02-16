<?php

namespace Litepie\Blog\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Blog\Repositories\Presenter\BlogCategoryItemTransformer;

/**
 * Pubic API controller class.
 */
class BlogCategoryPublicController extends BaseController
{
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
            ->setPresenter('\\Litepie\\Blog\\Repositories\\Presenter\\BlogCategoryListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $blog_categories['code'] = 2000;
        return response()->json($blog_categories)
                ->setStatusCode(200, 'INDEX_SUCCESS');
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
        $blog_category = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($blog_category)) {
            $blog_category         = $this->itemPresenter($module, new BlogCategoryItemTransformer);
            $blog_category['code'] = 2001;
            return response()->json($blog_category)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
