<?php

namespace Litepie\Settings\Forms;

use Litepie\Form\FormInterpreter;

class Setting extends FormInterpreter
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
                'url'    => guard_url('settings/setting/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('settings/setting/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('settings/setting'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('settings/setting'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('settings'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('settings/setting'),
                'method' => 'DELETE',
            ],
        ];
        self::$orderBy = [
        ];
        self::$search = [
            'name' => [
                'type'        => 'text',
                'label'       => trans('settings::settings.label.name'),
                'placeholder' => trans('settings::settings.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '4',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('settings::settings.groups.main'),
            'details'  => trans('settings::settings.groups.details'),
            'images'   => trans('settings::settings.groups.images'),
            'settings' => trans('settings::settings.groups.settings'),
        ];
        self::$list = [
            [
                'key'      => 'ref',
                'label'    => trans('settings::settings.label.ref'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'id',
                'label'    => trans('settings::settings.label.id'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'name',
                'label'    => trans('settings::settings.label.name'),
                'sortable' => 'true',
                'roles'    => [],
            ],
            [
                'key'      => 'status',
                'label'    => trans('settings::settings.label.status'),
                'sortable' => 'true',
                'roles'    => [],
            ],
        ];
        self::$fields = [
            'key' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('settings::setting.label.key'),
                'placeholder' => trans('settings::setting.placeholder.key'),
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
            'package' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('settings::setting.label.package'),
                'placeholder' => trans('settings::setting.placeholder.package'),
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
            'module' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('settings::setting.label.module'),
                'placeholder' => trans('settings::setting.placeholder.module'),
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
                'label'       => trans('settings::setting.label.name'),
                'placeholder' => trans('settings::setting.placeholder.name'),
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
            'value' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('settings::setting.label.value'),
                'placeholder' => trans('settings::setting.placeholder.value'),
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
                'label'       => trans('settings::setting.label.file'),
                'placeholder' => trans('settings::setting.placeholder.file'),
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
            'control' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('settings::setting.label.control'),
                'placeholder' => trans('settings::setting.placeholder.control'),
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
                'element'     => 'radios',
                'type'        => 'radios',
                'label'       => trans('settings::setting.label.type'),
                'placeholder' => trans('settings::setting.placeholder.type'),
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
