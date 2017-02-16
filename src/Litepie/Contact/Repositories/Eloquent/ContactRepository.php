<?php

namespace Litepie\Contact\Repositories\Eloquent;

use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.contact.contact.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.contact.contact.model');
    }
}
