<?php

namespace Litepie\Blog\Repositories\Eloquent;

use Litepie\Blog\Interfaces\BlogCategoryRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class BlogCategoryRepository extends BaseRepository implements BlogCategoryRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.blog.blog_category.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.blog.blog_category.model');
    }
}
