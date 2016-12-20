<?php

namespace Litepie\Contact\Repositories\Eloquent;

use Litepie\Contact\Interfaces\ContactRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like'
    ];

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
        return config('litepie.contact.contact.model');
    }
}
