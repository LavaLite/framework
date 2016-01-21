<?php
namespace Litepie\Database\Events;

use Illuminate\Database\Eloquent\Model;
use Litepie\Database\Contracts\RepositoryInterface;

/**
 * Class RepositoryEventBase
 * @package Litepie\Database\Events
 */
abstract class RepositoryEventBase
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var string
     */
    protected $action;

    /**
     * @param RepositoryInterface $repository
     * @param Model $model
     */
    public function __construct(RepositoryInterface $repository, Model $model)
    {
        $this->repository   = $repository;
        $this->model        = $model;
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @return RepositoryInterface
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