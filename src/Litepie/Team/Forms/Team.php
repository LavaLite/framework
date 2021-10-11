<?php

namespace Litepie\Team\Forms;

use Litepie\Form\FormInterpreter;

class Team extends FormInterpreter
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
                'url'    => guard_url('team/team/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('team/team/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('team/team'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('team/team'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('team/team'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('team/team'),
                'method' => 'DELETE',
            ],
        ];
        self::$search = [
            'name' => [
                'type'        => 'text',
                'label'       => trans('team::team.label.name'),
                'placeholder' => trans('team::team.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '4',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('team::team.groups.main'),
            'details'  => trans('team::team.groups.details'),
            'images'   => trans('team::team.groups.images'),
            'settings' => trans('team::team.groups.settings'),
        ];
        self::$orderBy = [
            'created_at' => trans('team::team.label.created_at'),
            'name' => trans('team::team.label.title'),
            'status' => trans('team::team.label.status'),
        ];
        self::$list = [
            [
                'key'      => 'ref',
                'label'    => trans('team::team.label.ref'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'id',
                'label'    => trans('team::team.label.id'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'name',
                'label'    => trans('team::team.label.name'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'status',
                'label'    => trans('team::team.label.status'),
                'sortable' => 'true',
                'roles'    => [],
            ],
        ];
        self::$fields = [
            'Name' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('team::team.label.Name'),
                'placeholder' => trans('team::team.placeholder.Name'),
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
                'label'       => trans('team::team.label.description'),
                'placeholder' => trans('team::team.placeholder.description'),
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
            'settings' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('team::team.label.settings'),
                'placeholder' => trans('team::team.placeholder.settings'),
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
                'label'       => trans('team::team.label.type'),
                'placeholder' => trans('team::team.placeholder.type'),
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
            'created_by' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('team::team.label.created_by'),
                'placeholder' => trans('team::team.placeholder.created_by'),
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
