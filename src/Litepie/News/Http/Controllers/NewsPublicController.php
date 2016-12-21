<?php

namespace Litepie\News\Http\Controllers;

use App\Http\Controllers\PublicController as BaseController;
use Litepie\News\Interfaces\NewsRepositoryInterface;

class NewsPublicController extends BaseController
{
    use NewsWorkflow;
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
            ->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'))
            ->scopeQuery(function ($query) {
                return $query->orderBy('id', 'DESC');
            })->paginate();

        return $this->theme->of('news::public.news.index', compact('news'))->render();
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
        $news = $this->repository->scopeQuery(function ($query) use ($slug) {
            return $query->orderBy('id', 'DESC')
                ->where('slug', $slug);
        })->first(['*']);

        return $this->theme->of('news::public.news.show', compact('news'))->render();
    }
}
