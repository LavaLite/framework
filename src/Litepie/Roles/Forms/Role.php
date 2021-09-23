<?php

namespace Litepie\Roles\Forms;

use Litepie\Form\FormInterpreter;

class Role extends FormInterpreter
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
                'url'    => guard_url('role/role/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('role/role/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('role/role'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('role/role'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('role/role'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('role/role'),
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
                'col'         => '4',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('role.role.groups.main'),
            'details'  => trans('role.role.groups.details'),
            'images'   => trans('role.role.groups.images'),
            'settings' => trans('role.role.groups.settings'),
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
                'col'         => '6',
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
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('role.role.label.description'),
                'placeholder' => trans('role.role.placeholder.description'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '6',
                'append'      => null,
                'prepend'     => null,
                'roles'       => [],
                'attributes'  => [
                    'wrapper' => [],
                    'label'   => [],
                    'element' => [],

                ],
            ],
            'level' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('role.role.label.level'),
                'placeholder' => trans('role.role.placeholder.level'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '6',
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
