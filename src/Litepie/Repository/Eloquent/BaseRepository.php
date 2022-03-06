<?php

namespace Litepie\Repository\Eloquent;

use Litepie\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class BaseRepository.
 *
 * @author Renfos Technologies Pvt. Ltd. <info@info@renfos.com>
 */
abstract class BaseRepository extends PrettusRepository
{
    /**
     * Push Criteria for filter the query.
     *
     * @param $criteria
     *
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     *
     * @return $this
     */
    public function pushCriteria($criteria)
    {
        if (is_string($criteria)) {
            $criteria = new $criteria();
        }
        if (!$criteria instanceof CriteriaInterface) {
            throw new RepositoryException('Class '.get_class($criteria).' must be an instance of Prettus\\Repository\\Contracts\\CriteriaInterface');
        }
        $this->criteria->push($criteria);

        return $this;
    }

    /**
     * Find data by id or return new if not exists.
     *
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrNew($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->findOrNew($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function newInstance(array $attributes)
    {
        $model = $this->model->newInstance($attributes);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Permanetly delete multiple records.
     *
     * @param array $ids The identifiers
     *
     * @return result
     */
    public function purge($ids)
    {
        return $this->model->onlyTrashed()->whereIn('id', $ids)->forceDelete();
    }

    /**
     * Restore multiple records.
     *
     * @param array $ids The identifiers
     *
     * @return result retn result for the restore
     */
    public function restore($ids)
    {
        return $this->model->onlyTrashed()->whereIn('id', $ids)->update(['deleted_at' => null]);
    }

    /**
     * Change status of the records.
     *
     * @param string $status The status
     * @param array  $ids    The identifiers
     *
     * @return result Result for the multiple updation
     */
    public function changeStatus($status, $ids)
    {
        return $this->model->whereIn('id', $ids)->update(['status' => $status]);
    }

    /**
     * Select multiple records.
     *
     * @param array $ids The identifiers
     *
     * @return Collection Return eloquesnt collection
     */
    public function findIds($ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Find data by slug.
     *
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBySlug($value = null, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->whereSlug($value)->first($columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * Find data by slug.
     *
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function toSql()
    {
        $this->applyCriteria();
        $this->applyScope();

        return $this->model->toSql();
    }
}
