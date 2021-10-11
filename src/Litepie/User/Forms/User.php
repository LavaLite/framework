<?php

namespace Litepie\User\Forms;

use Litepie\Form\FormInterpreter;

class User extends FormInterpreter
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
                'url'    => guard_url('user/user/new'),
                'method' => 'GET',
            ],
            'create' => [
                'url'    => guard_url('user/user/create'),
                'method' => 'GET',
            ],
            'store' => [
                'url'    => guard_url('user/user'),
                'method' => 'POST',
            ],
            'update' => [
                'url'    => guard_url('user/user'),
                'method' => 'PUT',
            ],
            'list' => [
                'url'    => guard_url('user/user'),
                'method' => 'GET',
            ],
            'delete' => [
                'url'    => guard_url('user/user'),
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
            'name' => trans('user::user.label.title'),
            'created_at' => trans('user::user.label.created_at'),
            'status' => trans('user::user.label.status'),
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
                'label'       => trans('user.user.label.reporting_to'),
                'placeholder' => trans('user.user.placeholder.reporting_to'),
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
            'team_id' => [
                'element'     => 'numeric',
                'type'        => 'numeric',
                'label'       => trans('user.user.label.team_id'),
                'placeholder' => trans('user.user.placeholder.team_id'),
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
                'label'       => trans('user.user.label.name'),
                'placeholder' => trans('user.user.placeholder.name'),
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
                'label'       => trans('user.user.label.email'),
                'placeholder' => trans('user.user.placeholder.email'),
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
                'label'       => trans('user.user.label.password'),
                'placeholder' => trans('user.user.placeholder.password'),
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
                'label'       => trans('user.user.label.api_token'),
                'placeholder' => trans('user.user.placeholder.api_token'),
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
                'label'       => trans('user.user.label.remember_token'),
                'placeholder' => trans('user.user.placeholder.remember_token'),
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
                'label'       => trans('user.user.label.sex'),
                'placeholder' => trans('user.user.placeholder.sex'),
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
                'label'       => trans('user.user.label.dob'),
                'placeholder' => trans('user.user.placeholder.dob'),
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
            'doj' => [
                'element'     => 'date_picker',
                'type'        => 'date_picker',
                'label'       => trans('user.user.label.doj'),
                'placeholder' => trans('user.user.placeholder.doj'),
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
                'label'       => trans('user.user.label.designation'),
                'placeholder' => trans('user.user.placeholder.designation'),
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
                'label'       => trans('user.user.label.mobile'),
                'placeholder' => trans('user.user.placeholder.mobile'),
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
                'label'       => trans('user.user.label.phone'),
                'placeholder' => trans('user.user.placeholder.phone'),
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
                'label'       => trans('user.user.label.address'),
                'placeholder' => trans('user.user.placeholder.address'),
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
                'label'       => trans('user.user.label.street'),
                'placeholder' => trans('user.user.placeholder.street'),
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
                'label'       => trans('user.user.label.city'),
                'placeholder' => trans('user.user.placeholder.city'),
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
                'label'       => trans('user.user.label.district'),
                'placeholder' => trans('user.user.placeholder.district'),
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
                'label'       => trans('user.user.label.state'),
                'placeholder' => trans('user.user.placeholder.state'),
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
                'label'       => trans('user.user.label.country'),
                'placeholder' => trans('user.user.placeholder.country'),
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
                'label'       => trans('user.user.label.photo'),
                'placeholder' => trans('user.user.placeholder.photo'),
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
                'label'       => trans('user.user.label.web'),
                'placeholder' => trans('user.user.placeholder.web'),
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
            'urls' => [
                'element'     => 'html_editor',
                'type'        => 'html_editor',
                'label'       => trans('user.user.label.urls'),
                'placeholder' => trans('user.user.placeholder.urls'),
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
                'label'       => trans('user.user.label.email_verified_at'),
                'placeholder' => trans('user.user.placeholder.email_verified_at'),
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
