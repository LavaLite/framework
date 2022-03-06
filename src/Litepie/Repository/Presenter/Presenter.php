<?php

namespace Litepie\Repository\Presenter;

use ArrayObject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Presenter extends ArrayObject implements Arrayable, Jsonable
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create a new Presenter instance.
     *
     * @param Model $model
     *
     * @return Presenter
     */
    public static function make(Model $model): Presenter
    {
        return new static($model);
    }

    /**
     * Create a new Presenter instance.
     *
     * @param Model $model
     *
     * @return Presenter
     */
    public static function present($model)
    {
        if ($model instanceof LengthAwarePaginator) {
            return self::pagination($model);
        } elseif ($model instanceof Paginator) {
            return self::simplePagination($model);
        }

        return self::collection($model);
    }

    /**
     * Create a collection of presented models.
     *
     * @param Collection $models
     *
     * @return Collection
     */
    public static function collection(Collection $models): Collection
    {
        return collect($models)->map(function ($model) {
            return new static($model);
        });
    }

    /**
     * Create a collection of paginated presented models.
     *
     * @param Paginator $paginator
     *
     * @return Collection
     */
    public static function pagination(Paginator $paginator): Collection
    {
        return collect([
            'data'  => static::collection(collect($paginator->items())),
            'links' => [
                'first' => $paginator->url(1),
                'last'  => $paginator->url($paginator->lastPage()),
                'prev'  => $paginator->previousPageUrl(),
                'next'  => $paginator->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => (int) $paginator->currentPage(),
                'from'         => (int) $paginator->firstItem(),
                'last_page'    => (int) $paginator->lastPage(),
                'links'        => $paginator->toArray()['links'],
                'path'         => $paginator->path(),
                'per_page'     => (int) $paginator->perPage(),
                'to'           => (int) $paginator->lastItem(),
                'total'        => (int) $paginator->total(),
            ],
        ]);
    }

    /**
     * Create a collection of paginated presented models.
     *
     * @param Paginator $paginator
     *
     * @return Collection
     */
    public static function simplePagination(Paginator $paginator): Collection
    {
        return collect([
            'data'  => static::collection(collect($paginator->items())),
            'links' => [
                'first' => $paginator->url(1),
                'prev'  => $paginator->previousPageUrl(),
                'next'  => $paginator->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => (int) $paginator->currentPage(),
                'from'         => (int) $paginator->firstItem(),
                'path'         => $paginator->path(),
                'per_page'     => (int) $paginator->perPage(),
                'to'           => (int) $paginator->lastItem(),
            ],
        ]);
    }

    /**
     * Property overloading.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        if ($this->model->offsetExists($name)) {
            return $this->model->offsetget($name);
        }

        return $this->model->$name;
    }

    /**
     * Method overloading.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->model, $method], $args);
    }

    /**
     * Convert the Presenter to a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Convert the Presenter to a JSON string.
     *
     * @param int $options
     *
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Check if a relationship has been eager-loaded.
     *
     * @param string $relationship
     *
     * @return mixed|null
     */
    protected function whenLoaded(string $relationship)
    {
        if (!$this->model->relationLoaded('period')) {
            return null;
        }

        return $this->model->$relationship;
    }
}
