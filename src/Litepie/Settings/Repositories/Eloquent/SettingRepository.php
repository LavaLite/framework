<?php

namespace Litepie\Settings\Repositories\Eloquent;

use Litepie\Settings\Interfaces\SettingRepositoryInterface;
use Litepie\Repository\Eloquent\BaseRepository;

class SettingRepository extends BaseRepository implements SettingRepositoryInterface
{


    public function boot()
    {
        $this->fieldSearchable = config('litepie.settings.setting.search');

    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return config('litepie.settings.setting.model');
    }
}
