<?php

namespace Litepie\Master\Forms;

use Litepie\Form\FormInterpreter;

class Master extends FormInterpreter
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
                'url'    => guard_url('masters/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('masters/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('masters'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('masters'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('masters'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('masters'),
                'method' => 'DELETE',
            ],
        ];
        self::$search = [
            'name' => [
                'type'        => 'text',
                'label'       => trans('master::master.label.name'),
                'placeholder' => trans('master::master.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '4',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('master::master.groups.main'),
            'details'  => trans('master::master.groups.details'),
            'images'   => trans('master::master.groups.images'),
            'settings' => trans('master::master.groups.settings'),
        ];
        self::$orderBy = [
        ];
        self::$list = [
            [
                'key'      => 'ref',
                'label'    => trans('master::master.label.ref'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'id',
                'label'    => trans('master::master.label.id'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'name',
                'label'    => trans('master::master.label.name'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'status',
                'label'    => trans('master::master.label.status'),
                'sortable' => 'true',
                'roles'    => [],
            ],
        ];
        self::$fields = [
            'parent_id' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('master::master.label.parent_id'),
                'placeholder' => trans('master::master.placeholder.parent_id'),
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
            'type' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.type'),
                'placeholder' => trans('master::master.placeholder.type'),
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
            'name' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.name'),
                'placeholder' => trans('master::master.placeholder.name'),
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
            'code' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.code'),
                'placeholder' => trans('master::master.placeholder.code'),
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
            'amount' => [
                'element'     => 'decimal',
                'type'        => 'decimal',
                'label'       => trans('master::master.label.amount'),
                'placeholder' => trans('master::master.placeholder.amount'),
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
            'abbr' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.abbr'),
                'placeholder' => trans('master::master.placeholder.abbr'),
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
                'label'       => trans('master::master.label.description'),
                'placeholder' => trans('master::master.placeholder.description'),
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
            'icon' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.icon'),
                'placeholder' => trans('master::master.placeholder.icon'),
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
            'image' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.image'),
                'placeholder' => trans('master::master.placeholder.image'),
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
            'images' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.images'),
                'placeholder' => trans('master::master.placeholder.images'),
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
            'file' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.file'),
                'placeholder' => trans('master::master.placeholder.file'),
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
            'order' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('master::master.label.order'),
                'placeholder' => trans('master::master.placeholder.order'),
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
            'extras' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('master::master.label.extras'),
                'placeholder' => trans('master::master.placeholder.extras'),
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
