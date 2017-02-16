<?php

namespace Litepie\Blog\Repositories\Eloquent;

use Litepie\Blog\Interfaces\BlogRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.blog.blog.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.blog.blog.model');
    }
}
