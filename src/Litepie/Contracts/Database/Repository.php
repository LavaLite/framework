<?php

namespace Litepie\Contracts\Database;

interface Repository
{
    /**
     * Retrieve all data of modal.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*']);

    /**
     * Retrieve all data of modal.
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function toArray($columns = ['*']);

    /**
     * Retrieve all data of modal, paginated.
     *
     * @param null  $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * Retrieve data of modal, as key value.
     *
     * @param null  $limit
     * @param array $columns
     *
     * @return mixed
     */
    public function lists($val, $key = null);

    /**
     * Find data by id.
     *
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']);

    /**
     * Find data by id and return new instance if not found.
     *
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findOrNew($id, $columns = ['*']);

    /**
     * Find data by field and value.
     *
     * @param $field
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = ['*']);

    /**
     * Find data by multiple fields.
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*']);

    /**
     * Find data by multiple values in one field.
     *
     * @param $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']);

    /**
     * Find data by excluding multiple values in one field.
     *
     * @param $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereNotIn($field, array $values, $columns = ['*']);

    /**
     * Save a new entity in modal.
     *
     * @param array $attributes
     *
     * @throws ValidatorException
     *
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update a entity in modal by id.
     *
     * @param array $attributes
     * @param $id
     *
     * @throws ValidatorException
     *
     * @return mixed
     */
    public function update(array $attributes, $id);

    /**
     * Delete a entity in modal by id.
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id);

    /**
     * Sets the order of the next query.
     *
     * @param string $column
     * @param string $order
     *
     * @return void
     */
    public function orderBy($column, $order = 'ASC');

    /**
     * Add where condition for next query.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return void
     */
    public function where($column, $operator, $value);

    /**
     * Add orWhere condition for next query.
     *
     * @param string $column
     * @param string $operator
     * @param string $value
     *
     * @return void
     */
    public function orWhere($column, $operator, $value);

    /**
     * Add whereBetween condition for next query.
     *
     * @param string $column
     * @param array  $value
     *
     * @return void
     */
    public function whereBetween($column, array $value);

    /**
     * Add whereNotBetween condition for next query.
     *
     * @param string $column
     * @param array  $value
     *
     * @return void
     */
    public function whereNotBetween($column, array $value);

    /**
     * Add whereIn condition for next query.
     *
     * @param string $column
     * @param array  $value
     *
     * @return void
     */
    public function whereIn($column, array $value);

    /**
     * Add whereNotIn condition for next query.
     *
     * @param string $column
     * @param array  $value
     *
     * @return void
     */
    public function whereNotIn($column, array $value);

    /**
     * Add whereNull condition for next query.
     *
     * @param string $column
     *
     * @return void
     */
    public function whereNull($column);

    /**
     * Add whereNotNull condition for next query.
     *
     * @param string $column
     *
     * @return void
     */
    public function whereNotNull($column);

    /**
     * Load relations.
     *
     * @param array|string $relations
     *
     * @return $this
     */
    public function with($relations);

    /**
     * Set hidden fields.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function hidden(array $fields);

    /**
     * Set visible fields.
     *
     * @param array $fields
     *
     * @return $this
     */
    public function visible(array $fields);
}
