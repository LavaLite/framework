<?php

namespace Litepie\Menu\Forms;

use Litepie\Form\FormInterpreter;

class Menu extends FormInterpreter
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
                'url'    => guard_url('menu/menu/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('menu/menu/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('menu/menu'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('menu/menu'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('menu/menu'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('menu/menu'),
                'method' => 'DELETE',
            ],
        ];

        self::$search = [
        ];
        self::$orderBy = [
        ];

        self::$groups = [
            'main'     => trans('user.user.groups.main'),
            'details'  => trans('user.user.groups.details'),
            'images'   => trans('user.user.groups.images'),
            'settings' => trans('user.user.groups.settings'),
        ];
        self::$list = [
            [
                'key'      => 'ref',
                'label'    => trans('user.user.label.ref'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'id',
                'label'    => trans('user.user.label.id'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'name',
                'label'    => trans('user.user.label.name'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'status',
                'label'    => trans('user.user.label.status'),
                'sortable' => 'true',
                'roles'    => [],
            ],
        ];
        self::$fields = [

        ];

        return new static();
    }
}
