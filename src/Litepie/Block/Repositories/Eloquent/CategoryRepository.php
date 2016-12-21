<?php

namespace Litepie\Block\Repositories\Eloquent;

use Litepie\Block\Interfaces\CategoryRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
    public function boot()
    {
        $this->pushCriteria(app('Litepie\Repository\Criteria\RequestCriteria'));
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        $this->fieldSearchable = config('litepie.block.category.search');
        return config('litepie.block.category.model');
    }
}
