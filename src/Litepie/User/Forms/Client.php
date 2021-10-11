<?php

namespace Litepie\User\Forms;

use Litepie\Form\FormInterpreter;

class Client extends FormInterpreter
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
                'url'    => guard_url('user/client/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('user/client/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('user/client'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('user/client'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('user/client'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('user/client'),
                'method' => 'DELETE',
            ],
        ];
        self::$search = [
            'name' => [
                'type'        => 'text',
                'label'       => trans('user.user.label.name'),
                'placeholder' => trans('user.user.placeholder.name'),
                'rules'       => '',
                'group'       => 'main',
                'section'     => 'first',
                'col'         => '4',
                'roles'       => [],
            ],
        ];
        self::$groups = [
            'main'     => trans('user.user.groups.main'),
            'details'  => trans('user.user.groups.details'),
            'images'   => trans('user.user.groups.images'),
            'settings' => trans('user.user.groups.settings'),
        ];
        self::$orderBy = [
            'name' => trans('user.client.label.name'),
            'created_at' => trans('user.client.label.created_at'),
            'status' => trans('user.client.label.status'),
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
            'reporting_to' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('user.client.label.reporting_to'),
                'placeholder' => trans('user.client.placeholder.reporting_to'),
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
                'label'       => trans('user.client.label.name'),
                'placeholder' => trans('user.client.placeholder.name'),
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
            'email' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.email'),
                'placeholder' => trans('user.client.placeholder.email'),
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
            'password' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.password'),
                'placeholder' => trans('user.client.placeholder.password'),
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
            'api_token' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.api_token'),
                'placeholder' => trans('user.client.placeholder.api_token'),
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
            'remember_token' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.remember_token'),
                'placeholder' => trans('user.client.placeholder.remember_token'),
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
            'sex' => [
                'element'     => 'radios',
                'type'        => 'radios',
                'label'       => trans('user.client.label.sex'),
                'placeholder' => trans('user.client.placeholder.sex'),
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
            'dob' => [
                'element'     => 'date_picker',
                'type'        => 'date_picker',
                'label'       => trans('user.client.label.dob'),
                'placeholder' => trans('user.client.placeholder.dob'),
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
            'designation' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.designation'),
                'placeholder' => trans('user.client.placeholder.designation'),
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
            'mobile' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.mobile'),
                'placeholder' => trans('user.client.placeholder.mobile'),
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
            'phone' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.phone'),
                'placeholder' => trans('user.client.placeholder.phone'),
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
            'address' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.address'),
                'placeholder' => trans('user.client.placeholder.address'),
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
            'street' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.street'),
                'placeholder' => trans('user.client.placeholder.street'),
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
            'city' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.city'),
                'placeholder' => trans('user.client.placeholder.city'),
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
            'district' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.district'),
                'placeholder' => trans('user.client.placeholder.district'),
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
            'state' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.state'),
                'placeholder' => trans('user.client.placeholder.state'),
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
            'country' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('user.client.label.country'),
                'placeholder' => trans('user.client.placeholder.country'),
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
            'photo' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.photo'),
                'placeholder' => trans('user.client.placeholder.photo'),
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
            'web' => [
                'element'     => 'text',
                'type'        => 'text',
                'label'       => trans('user.client.label.web'),
                'placeholder' => trans('user.client.placeholder.web'),
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
            'permissions' => [
                'element'     => 'html_editor',
                'type'        => 'html_editor',
                'label'       => trans('user.client.label.permissions'),
                'placeholder' => trans('user.client.placeholder.permissions'),
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
            'email_verified_at' => [
                'element'     => 'date_time_picker',
                'type'        => 'date_time_picker',
                'label'       => trans('user.client.label.email_verified_at'),
                'placeholder' => trans('user.client.placeholder.email_verified_at'),
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
