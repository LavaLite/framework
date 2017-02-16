<?php

namespace Litepie\Revision\Repositories\Eloquent;

use Litepie\Revision\Interfaces\RevisionRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class RevisionRepository extends BaseRepository implements RevisionRepositoryInterface
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
        $this->fieldSearchable = config('litepie.revision.revision.search');
        return config('litepie.revision.revision.model');
    }
    
}
