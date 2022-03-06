<?php

namespace Litepie\Repository\Filter;

use Litepie\Repository\Interfaces\FilterInterface;
use Litepie\Repository\Interfaces\RepositoryInterface;

class RequestFilter implements FilterInterface
{
    /**
     * Searchable fields array.
     *
     * @var array
     */
    protected $searchFields = [];

    /**
     * Searchable fields array.
     *
     * @var array
     */
    protected $searchArray = [];

    public function apply($model, RepositoryInterface $repository)
    {
        $search = isset($this->input['q']) ? $this->input['q'] : [];
        if (empty($search)) {
            return $model;
        }

        $this->searchFields = $this->searchFields();
        $this->prepareSearch($search);

        return $this->applyFilters($model);
    }

    public function applyFilters($model)
    {
        $fields = $this->searchFields;
        $search = isset($this->searchArray['q']) ? $this->searchArray['q'] : $this->searchArray;
        if (empty($search)) {
            return;
        }
        if (!is_array($search)) {
            $model->where(function ($query) use ($fields, $search) {
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

                return $query;
            });

            return $model;
        }
        if (is_array($search)) {
            $model->where(function ($query) use ($search) {
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

            return $model;
        }

        return $model;
    }

    public function prepareSearch($search)
    {
        $searchFields = array_keys($this->searchFields);
        if (!stripos($search, ';') || !stripos($search, ':')) {
            return $this->searchArray['q'] = $search;
        }

        $searches = explode(';', $search);
        foreach ($searches as $key => $search) {
            $searches[$key] = explode(':', $search);
            if (!in_array($searches[$key][0], $searchFields)) {
                unset($searches[$key]);
                continue;
            }
            $searches[$key]['field'] = $searches[$key][0];
            $searches[$key]['condition'] = '=';

            $searches[$key][1] = explode(',', @$searches[$key][1], 2);
            if (count($searches[$key][1]) == 1) {
                $searches[$key]['value'] = trim($searches[$key][1][0]);
                if (in_array(strtoupper($searches[$key]['value']), ['NULL', 'NOT NULL'])) {
                    $searches[$key]['condition'] = strtoupper($searches[$key]['value']);
                } else {
                    $searches[$key]['condition'] = '=';
                }

                unset($searches[$key][0]);
                unset($searches[$key][1]);
                continue;
            }
            $searches[$key]['condition'] = strtoupper($searches[$key][1][0]);
            $searches[$key]['value'] = trim($searches[$key][1][1]);
            unset($searches[$key][0]);
            unset($searches[$key][1]);

            if (isset($searches[$key]['value'])) {
                $searches[$key]['value'] = strtr($searches[$key]['value'], ['(' => '', ')' => '']);
            }
            if (in_array(strtoupper($searches[$key]['value']), ['NULL', 'NOT NULL'])) {
                $searches[$key]['condition'] = strtoupper($searches[$key]['value']);
            }
            if ($searches[$key]['condition'] == 'BETWEEN') {
                $searches[$key]['value'] = explode(',', $searches[$key]['value']);
                $searches[$key]['value'][0] = trim($searches[$key]['value'][0]);
                $searches[$key]['value'][1] = trim($searches[$key]['value'][1]);
                if ($searches[$key]['value'][1] == '' && $searches[$key]['value'][0] == '') {
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
            } elseif ($searches[$key]['condition'] == 'IN' || $searches[$key]['condition'] == 'NOT IN') {
                $searches[$key]['value'] = explode(',', $searches[$key]['value']);
            } elseif ($searches[$key]['condition'] == 'LIKE' || $searches[$key]['condition'] == 'NOT LIKE') {
                $searches[$key]['value'] = str_replace('*', '%', $searches[$key]['value']);
            }
        }
        if (count($searches)) {
            return $this->searchArray = $searches;
        } else {
            return $this->searchArray['q'] = $search;
        }
    }

    /**
     * Returne the search fields for the model.
     *
     * @return array
     */
    private function searchFields()
    {
        $originalFields = $this->query->getModel()->searchFields();
        foreach ($originalFields as $field => $condition) {
            if (is_numeric($field)) {
                $originalFields[$condition] = '=';
                unset($originalFields[$field]);
            }
        }

        return $originalFields;
    }
}
