<?php

namespace Litepie\Calendar\Repositories\Eloquent;

use Litepie\Calendar\Interfaces\CalendarRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class CalendarRepository extends BaseRepository implements CalendarRepositoryInterface
{
    /**
     * Booting the repository.
     *
     * @return null
     */
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
        $this->fieldSearchable = config('litepie.calendar.calendar.search');
        return config('litepie.calendar.calendar.model');
    }


}
