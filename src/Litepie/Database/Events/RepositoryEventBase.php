<?php

namespace Litepie\Database\Events;

use Illuminate\Database\Eloquent\Model;
use Litepie\Contracts\Database\Repository;

/**
 * Class RepositoryEventBase.
 */
abstract class RepositoryEventBase
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Repository
     */
    protected $repository;

    /**
     * @var string
     */
    protected $action;

    /**
     * @param Repository $repository
     * @param Model      $model
     */
    public function __construct(Repository $repository, Model $model)
    {
        $this->repository = $repository;
        $this->model = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return Repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }
}
