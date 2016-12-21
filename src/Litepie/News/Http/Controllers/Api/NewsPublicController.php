<?php

namespace Litepie\News\Http\Controllers\Api;

use App\Http\Controllers\Api\PublicController as BaseController;
use Litepie\News\Interfaces\NewsRepositoryInterface;
use Litepie\News\Repositories\Presenter\NewsItemTransformer;

/**
 * Pubic API controller class.
 */
class NewsPublicApiController extends BaseController
{
    /**
     * Constructor.
     *
     * @param type \Litepie\News\Interfaces\NewsRepositoryInterface $news
     *
     * @return type
     */
    public function __construct(NewsRepositoryInterface $news)
    {
        $this->repository = $news;
        parent::__construct();
    }

    /**
     * Show news's list.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function index()
    {
        $news = $this->repository
            ->setPresenter('\\Litepie\\News\\Repositories\\Presenter\\NewsListPresenter')
            ->scopeQuery(function($query){
                return $query->orderBy('id','DESC');
            })->paginate();

        $news['code'] = 2000;
        return response()->json($news)
                ->setStatusCode(200, 'INDEX_SUCCESS');
    }

    /**
     * Show news.
     *
     * @param string $slug
     *
     * @return response
     */
    protected function show($slug)
    {
        $news = $this->repository
            ->scopeQuery(function($query) use ($slug) {
            return $query->orderBy('id','DESC')
                         ->where('slug', $slug);
        })->first(['*']);

        if (!is_null($news)) {
            $news         = $this->itemPresenter($module, new NewsItemTransformer);
            $news['code'] = 2001;
            return response()->json($news)
                ->setStatusCode(200, 'SHOW_SUCCESS');
        } else {
            return response()->json([])
                ->setStatusCode(400, 'SHOW_ERROR');
        }

    }
}
