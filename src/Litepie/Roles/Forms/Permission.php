<?php

namespace Litepie\Roles\Forms;

use Litepie\Form\FormInterpreter;

class Permission extends FormInterpreter
{
    /**
     * Sets the form and form elements.
     *
     * @return null.
     */
    public static function setAttributes()
    {
        self::$urls = [
            'new' => [
                'url'    => guard_url('role/permission/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('role/permission/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('role/permission'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('role/permission'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('role/permission'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('role/permission'),
                'method' => 'DELETE',
            ],
        ];
        self::$search = [
            'name' => [
                'type'        => 'text',
                'label'       => trans('role.role.label.name'),
                'placeholder' => trans('role.role.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '12',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('role.role.groups.main')
        ];
        self::$orderBy = [
            'name' => trans('role.role.label.name'),
            'created_at' => trans('role.role.label.created_at'),
        ];
        self::$list = [
            [
                'key'      => 'ref',
                'label'    => trans('role.role.label.ref'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'id',
                'label'    => trans('role.role.label.id'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'name',
                'label'    => trans('role.role.label.name'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'status',
                'label'    => trans('role.role.label.status'),
                'sortable' => 'true',
                'roles'    => [],
            ],
        ];
        self::$fields = [
            'name' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('role.role.label.name'),
                'placeholder' => trans('role.role.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '12',
                'append'      => null,
                'prepend'     => null,
                'roles'       => [],
                'attributes'  => [
                    'wrapper' => [],
                    'label'   => [],
                    'element' => [],

                ],
            ],
            'description' => [
                'element'     => 'textarea',
                'type'        => 'text',
                'label'       => trans('role.role.label.description'),
                'placeholder' => trans('role.role.placeholder.description'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '12',
                'append'      => null,
                'prepend'     => null,
                'roles'       => [],
                'attributes'  => [
                    'wrapper' => [],
                    'label'   => [],
                    'element' => [],

                ],
            ],
        ];

        return new static();
    }
}
