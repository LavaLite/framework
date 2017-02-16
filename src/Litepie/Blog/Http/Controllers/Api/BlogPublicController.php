<?php

namespace Litepie\Blog\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\Blog\Interfaces\BlogRepositoryInterface;
use Litepie\Blog\Repositories\Presenter\BlogItemTransformer;

/**
 * Pubic API controller class.
 */
class BlogPublicController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\Blog\Interfaces\BlogRepositoryInterface $blog
     *
     * @return type
     */
    public function __construct(BlogRepositoryInterface $blog)
    {
        $this->repository = $blog;
        parent::__construct();
    }

    /**
     * Show blog's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $blogs = $this->repository
            ->setPresenter('\\Litepie\\Blog\\Repositories\\Presenter\\BlogListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $blogs['code'] = 2000;
        return response()->json($blogs)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show blog.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $blog = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($blog)) {
            $blog         = $this->itemPresenter($module, new BlogItemTransformer);
            $blog['code'] = 2001;
            return response()->json($blog)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
