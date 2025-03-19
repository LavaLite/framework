<?php

namespace Litepie\Database\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class RequestScope implements Scope
{
    /**
     * Searchable fields array.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model   $builder
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder = $this->applyFilters($builder, $model);
        $builder = $this->applySort($builder, $model);
    }

    public function applySort(Builder $builder, Model $model)
    {
        $fields = $this->getSearchFields($model);
        $sort = request()->input('sort', []);

        if (empty($sort)) {
            return $builder;
        }

        $sorts = $this->prepareSort($sort, $fields);

        if (empty($sorts)) {
            return $builder;
        }

        foreach ($sorts as $sort) {
            $builder->orderBy($sort['field'], $sort['order']);
        }

        return $builder;
    }

    public function applyFilters(Builder $builder, Model $model)
    {
        $fields = $model->getSearchFields();
        $search = request()->input('q', []);
        if (empty($search)) {
            return $builder;
        }

        $search = $this->prepareSearch($search, $fields);
        if (!is_array($search)) {
            $builder->where(function ($query) use ($fields, $search) {
                $isFirstField = true;

                foreach ($fields as $field => $condition) {
                    if (!in_array($condition, ['like', '=', 'in'])) {
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

                return $query;
            });

            return $builder;
        }
        if (is_array($search)) {
            $builder->where(function ($query) use ($search) {
                foreach ($search as $sArray) {
                    $field = $sArray['field'];
                    $condition = $sArray['condition'];
                    $value = $sArray['value'];

                    if (is_null($value)) {
                        $query->whereNull($field);
                    } elseif (in_array($condition, ['=', '>', '>=', '<', '<=', '!=', '<>'])) {
                        $query->where($field, $condition, $value);
                    } elseif ($condition == 'LIKE') {
                        $query->where($field, $condition, $value);
                    } elseif ($condition == 'NOT LIKE') {
                        $query->where($field, $condition, $value);
                    } elseif ($condition == 'BETWEEN') {
                        $query->whereBetween($field, $value);
                    } elseif ($condition == 'NOT BETWEEN') {
                        $query->whereNotBetween($field, $value);
                    } elseif ($condition == 'IN' && is_array($value)) {
                        $query->whereIn($field, $value);
                    } elseif ($condition == 'NOT IN' && is_array($value)) {
                        $query->whereNotIn($field, $value);
                    } elseif ($condition == 'NULL') {
                        $query->whereNull($field);
                    } elseif ($condition == 'NOT NULL') {
                        $query->whereNotNull($field);
                    }
                }

                return $query;
            });

            return $builder;
        }

        return $builder;
    }

    private function prepareSearch($search, $fields)
    {
        if (!stripos($search, ';') && !stripos($search, ':')) {
            return $search;
        }

        $fields = array_keys($fields);
        $searches = explode(';', $search);

        foreach ($searches as $key => $search) {
            $searches[$key] = explode(':', $search);

            if (!in_array($searches[$key][0], $fields)) {
                unset($searches[$key]);
                continue;
            }

            $searches[$key]['field'] = $searches[$key][0];
            $searches[$key]['condition'] = '=';
            $value = @str_replace(['(', ')'], [',', ''], $searches[$key][1]);

            $searches[$key][1] = explode(',', $value, 2);
            if (count($searches[$key][1]) == 1) {
                $searches[$key]['value'] = trim($searches[$key][1][0]);

                if (in_array(strtoupper($searches[$key]['value']), ['NULL', 'NOT NULL'])) {
                    $searches[$key]['condition'] = strtoupper($searches[$key]['value']);
                }

                unset($searches[$key][0]);
                unset($searches[$key][1]);
                continue;
            }

            $searches[$key]['condition'] =
            $condition = strtoupper($searches[$key][1][0]);
            $searches[$key]['value'] = trim($searches[$key][1][1]);
            unset($searches[$key][0]);
            unset($searches[$key][1]);

            if (in_array(strtoupper($searches[$key]['value']), ['NULL', 'NOT NULL'])) {
                $searches[$key]['condition'] = strtoupper($searches[$key]['value']);
            }

            if ($condition == 'BETWEEN') {
                $searches[$key]['value'] = explode(',', $searches[$key]['value']);
                $searches[$key]['value'][0] = trim(@$searches[$key]['value'][0]);
                $searches[$key]['value'][1] = trim(@$searches[$key]['value'][1]);

                if (empty($searches[$key]['value'][1]) && empty($searches[$key]['value'][0])) {
                    unset($searches[$key]);
                    continue;
                }
                if ($searches[$key]['value'][1] == '') {
                    $searches[$key]['condition'] = '>';
                    $searches[$key]['value'] = $searches[$key]['value'][0];
                } elseif ($searches[$key]['value'][0] == '') {
                    $searches[$key]['condition'] = '<';
                    $searches[$key]['value'] = $searches[$key]['value'][1];
                }
            } elseif (in_array($condition, ['IN', 'NOT IN'])) {
                $searches[$key]['value'] = explode(',', $searches[$key]['value']);
            } elseif (in_array($condition, ['LIKE', 'NOT LIKE'])) {
                $searches[$key]['value'] = str_replace('*', '%', $searches[$key]['value']);
            }
        }

        return $searches;
    }

    private function prepareSort($sort, $fields)
    {
        if (!stripos($sort, ';') && !stripos($sort, ':')) {
            return [[
                'field' => $sort,
                'order' => 'ASC',
            ]];
        }

        $fields = array_keys($fields);
        $sorts = explode(';', $sort);

        foreach ($sorts as $key => $sort) {
            $sorts[$key] = explode(':', $sort);

            if (!in_array($sorts[$key][0], $fields)) {
                unset($sorts[$key]);
                continue;
            }

            $sorts[$key]['field'] = $sorts[$key][0];
            $sorts[$key]['order'] = 'ASC';
            if (isset($sorts[$key][1]) &&
                strtoupper($sorts[$key][1]) == 'DESC') {
                $sorts[$key]['order'] = 'DESC';
            }
            unset($sorts[$key][0]);
            unset($sorts[$key][1]);
        }

        return $sorts;
    }

    /**
     * Returne the search fields for the model.
     *
     * @return array
     */
    private function getSearchFields(Model $model)
    {
        $search = $model->getSearchFields();
        foreach ($search as $field => $condition) {
            if (is_numeric($field)) {
                $search[$condition] = '=';
                unset($search[$field]);
            }
        }

        return $search;
    }
}
