<?php

namespace Litepie\News\Repositories\Eloquent;

use Litepie\News\Interfaces\NewsRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{

    public function boot()
    {

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.news.news.search');
        return config('litepie.news.news.model');
    }
}
