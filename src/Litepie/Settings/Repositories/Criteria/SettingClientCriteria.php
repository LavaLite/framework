<?php

namespace Litepie\Settings\Repositories\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

class SettingClientCriteria implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
                        ->where('user_id','=', user_id('client.web'))
                        ->where('user_type','=', user_type('client.web'));
        return $model;
    }
}