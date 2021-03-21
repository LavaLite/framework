<?php

namespace Litepie\Repository\Criteria;

use Litepie\Repository\Contracts\CriteriaInterface;
use Litepie\Repository\Contracts\RepositoryInterface;

/**
 * Class RequestCriteria.
 */
class RequestCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository.
     *
     * @param $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $fieldsSearchable = $repository->getFieldsSearchable();

        $search = request()->get(config('repository.criteria.params.search', 'search'), null);
        $q = request()->get('q', null);
        if ($q != null) {
            $search['q'] = $q;
        }
        $searchFields = request()->get(config('repository.criteria.params.searchFields', 'searchFields'), null);
        $columns = request()->get(config('repository.criteria.params.columns', 'columns'), null);
        $sortBy = request()->get(config('repository.criteria.params.sortBy', 'sortBy'), null);
        $sortOrder = request()->get(config('repository.criteria.params.sortOrder', 'sortOrder'), 'asc');
        $with = request()->get(config('repository.criteria.params.with', 'with'), null);
        $sortOrder = !empty($sortOrder) ? $sortOrder : 'asc';
        $modelForceAndWhere = is_array($search);

        if ($search && is_array($fieldsSearchable) && count($fieldsSearchable)) {
            $searchFields = is_array($searchFields) || is_null($searchFields) ? $searchFields : explode(';', $searchFields);
            $fields = $this->parserFieldsSearch($fieldsSearchable, $searchFields);
            $searchData = $this->parserSearchData($search);
            $search = $this->parserSearchValue($search);

            if ($search != '') {
                $model = $model->where(function ($query) use ($fields, $search) {
                    $isFirstField = true;

                    foreach ($fields as $field => $condition) {
                        if ($condition != 'like') {
                            continue;
                        }

                        $value = "%{$search}%";

                        if ($isFirstField && !is_null($value)) {
                            $query->where($field, 'like', $value);
                            $isFirstField = false;
                        } elseif (!is_null($value)) {
                            $query->orWhere($field, 'like', $value);
                        }
                    }
                });
            }

            if (is_array($searchData) && count($searchData)) {
                $model = $model->where(function ($query) use ($fields, $searchData) {
                    $mergBetween = function ($array, $default) {
                        $array = array_values($array);
                        $default = array_values($default);

                        return $array + $default;
                    };

                    foreach ($fields as $field => $condition) {
                        $default = null;

                        if (is_numeric($field)) {
                            $field = $condition;
                            $condition = '=';
                        } elseif (is_array($condition)) {
                            $default = $condition['default'];
                            $condition = $condition['condition'];
                        }

                        $value = null;

                        $condition = trim(strtolower($condition));

                        if (isset($searchData[$field])) {
                            $value = $searchData[$field];

                            if (in_array($condition, ['=', '>', '>=', '<', '<=', '!=', '<>'])) {
                                $query->where($field, $condition, $value);
                            } elseif ($condition == 'like') {
                                $query->where($field, $condition, "%{$value}%");
                            } elseif ($condition == 'not like') {
                                $query->where($field, $condition, $value);
                            } elseif ($condition == 'between' && is_array($value) && !empty($value[0]) && !empty($value[1])) {
                                $query->whereBetween($field, $mergBetween($value, $default));
                            } elseif ($condition == 'not between' && is_array($value) && !empty($value[0]) && !empty($value[1])) {
                                $query->whereNotBetween($field, $mergBetween($value, $default));
                            } elseif ($condition == 'in' && is_array($value)) {
                                $query->whereIn($field, $value);
                            } elseif ($condition == 'not in' && is_array($value)) {
                                $query->whereNotIn($field, $value);
                            } elseif ($condition == 'null') {
                                $query->whereNull($field);
                            } elseif ($condition == 'not null') {
                                $query->whereNotNull($field);
                            }
                        }
                    }
                });
            }
        }

        if (isset($sortBy) && !empty($sortBy)) {
            $model = $model->orderBy($sortBy, $sortOrder);
        }

        if (isset($columns) && !empty($columns)) {
            if (is_string($columns)) {
                $columns = explode(';', $columns);
            }

            $model = $model->select($columns);
        }

        if ($with) {
            $with = explode(';', $with);
            $model = $model->with($with);
        }

        return $model;
    }

    /**
     * @param $search
     *
     * @return array
     */
    protected function parserSearchData($search)
    {
        if (is_array($search)) {
            foreach ($search as $key => $value) {
                if ($value == '') {
                    unset($search[$key]);
                }
            }

            return $search;
        }

        $searchData = [];

        if (stripos($search, ':')) {
            $fields = explode(';', $search);

            foreach ($fields as $row) {
                try {
                    list($field, $value) = explode(':', $row);
                    $searchData[$field] = $value;
                } catch (\Exception $e) {
                    //Surround offset error
                }
            }
        }

        return $searchData;
    }

    /**
     * @param $search
     *
     * @return null
     */
    protected function parserSearchValue($search)
    {
        if (is_array($search)) {
            return isset($search['q']) ? $search['q'] : null;
        }

        if (stripos($search, ';') || stripos($search, ':')) {
            $values = explode(';', $search);

            foreach ($values as $value) {
                $s = explode(':', $value);

                if (count($s) == 1) {
                    return $s[0];
                }
            }

            return;
        }

        return $search;
    }

    protected function parserFieldsSearch(array $fields = [], array $searchFields = null)
    {
        if (!is_null($searchFields) && count($searchFields)) {
            $acceptedConditions = config('repository.criteria.acceptedConditions', ['=', '>', '>=', '<', '<=', '!=', '<>', 'like', 'not like', 'between', 'not between', 'in', 'not in', 'null', 'not null']);
            $originalFields = $fields;
            $fields = [];

            foreach ($searchFields as $index => $field) {
                $field_parts = explode(':', $field);
                $_index = array_search($field_parts[0], $originalFields);

                if (count($field_parts) == 2) {
                    if (in_array($field_parts[1], $acceptedConditions)) {
                        unset($originalFields[$_index]);
                        $field = $field_parts[0];
                        $condition = $field_parts[1];
                        $originalFields[$field] = $condition;
                        $searchFields[$index] = $field;
                    }
                }
            }

            foreach ($originalFields as $field => $condition) {
                if (is_numeric($field)) {
                    $field = $condition;
                    $condition = '=';
                }

                if (in_array($field, $searchFields)) {
                    $fields[$field] = $condition;
                }
            }

            if (count($fields) == 0) {
                throw new \Exception(trans('database::criteria.fields_not_accepted', ['field' => implode(',', $searchFields)]));
            }
        }

        return $fields;
    }
}
