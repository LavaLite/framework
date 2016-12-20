<?php

namespace Litepie\News;

use User;

class News
{
    /**
     * $news object.
     */
    protected $news;

    /**
     * Constructor.
     */
    public function __construct(\Litepie\News\Interfaces\NewsRepositoryInterface $news)
    {
        $this->news = $news;
    }

    /**
     * Returns count of news.
     *
     * @param array $filter
     *
     * @return int
     */
    public function count($type='admin.web')
    {
        return $this->news->scopeQuery(function ($query) use ($type){
            return $query->whereUserId(user_id($type))->whereUserType(user_type($type));
        })->count();

    }

    /**
     * latest news.
     * @param int $count
     * @param string $view
     *
     * @return string
     */
    public function latest($count = 3, $view = 'public.news.latest')
    {

        $news = $this->news

            ->pushCriteria(new \Litepie\News\Repositories\Criteria\NewsPublicCriteria())
            ->scopeQuery(function ($query) use ($count) {
                return $query->orderBy('id', 'DESC')->take($count);
            })->all();

        return view('news::' . $view, compact('news'))->render();
    }

    /**
     * Make gadget View
     *
     * @param string $view
     *
     * @param int $count
     *
     * @return View
     */
    public function gadget($view = 'admin.news.gadget', $count = 10)
    {

        if (User::hasRole('user')) {
            $this->news->pushCriteria(new \Litepie\News\Repositories\Criteria\NewsUserCriteria());
        }

        $news = $this->news->scopeQuery(function ($query) use ($count) {
            return $query->orderBy('id', 'DESC')->take($count);
        })->all();

        return view('news::' . $view, compact('news'))->render();
    }

}
