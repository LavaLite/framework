<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for client in user package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  client module in user package
    | and it is used by the template/view files in this module
    |
    */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Client',
    'names' => 'Clients',
    'icon' => 'las la-list',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Clients',
        'sub' => 'Clients'
    ],

    /**
     * Singlular and plural name of the module
     */
    'groups'         => [
        'main' => 'Main',
        'images' => 'Images',
        'details' => 'Details',
        'settings' => 'Settings'
    ],

    /**
     * Form sub section name for the module.
     */
    'sections' => [
        'main' => 'Main',
        'details' => 'Details',
    ],

    /**
     * Options for select/radio/check.
     */
    'options'       => [
        'sex' => 
            [
                                
                [
                    'key'    => '',
                    'value'  => '',
                    'text'   => '',
                ],
                                
                [
                    'key'    => 'Male',
                    'value'  => 'Male',
                    'text'   => 'Male',
                ],
                                
                [
                    'key'    => 'Female',
                    'value'  => 'Female',
                    'text'   => 'Female',
                ],
                                
            ],

        'status' => 
            [
                                
                [
                    'key'    => 'New',
                    'value'  => 'New',
                    'text'   => 'New',
                ],
                                
                [
                    'key'    => 'Active',
                    'value'  => 'Active',
                    'text'   => 'Active',
                ],
                                
                [
                    'key'    => 'Suspended',
                    'value'  => 'Suspended',
                    'text'   => 'Suspended',
                ],
                                
                [
                    'key'    => 'Locked',
                    'value'  => 'Locked',
                    'text'   => 'Locked',
                ],
                                
            ],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder'   => [
        'id'                         => 'Please enter id',
        'name'                       => 'Please enter name',
        'email'                      => 'Please enter email',
        'password'                   => 'Please enter password',
        'api_token'                  => 'Please enter api token',
        'remember_token'             => 'Please enter remember token',
        'sex'                        => 'Please select sex',
        'dob'                        => 'Please select dob',
        'designation'                => 'Please enter designation',
        'mobile'                     => 'Please enter mobile',
        'phone'                      => 'Please enter phone',
        'address'                    => 'Please enter address',
        'street'                     => 'Please enter street',
        'city'                       => 'Please enter city',
        'Region'                     => 'Please select region',
        'state'                      => 'Please enter state',
        'country'                    => 'Please enter country',
        'photo'                      => 'Please enter photo',
        'web'                        => 'Please enter web',
        'status'                     => 'Please select status',
        'email_verified_at'          => 'Please select email verified at',
        'user_id'                    => 'Please enter user id',
        'user_type'                  => 'Please enter user type',
        'upload_folder'              => 'Please enter upload folder',
        'deleted_at'                 => 'Please select deleted at',
        'created_at'                 => 'Please select created at',
        'updated_at'                 => 'Please select updated at',
    ],

    /**
     * Labels for inputs.
     */
    'label'         => [
        'id'                         => 'Id',
        'name'                       => 'Name',
        'email'                      => 'Email',
        'password'                   => 'Password',
        'api_token'                  => 'Api token',
        'remember_token'             => 'Remember token',
        'sex'                        => 'Sex',
        'dob'                        => 'Dob',
        'designation'                => 'Designation',
        'mobile'                     => 'Mobile',
        'phone'                      => 'Phone',
        'address'                    => 'Address',
        'street'                     => 'Street',
        'city'                       => 'City',
        'Region'                     => 'Region',
        'state'                      => 'State',
        'country'                    => 'Country',
        'photo'                      => 'Photo',
        'web'                        => 'Web',
        'status'                     => 'Status',
        'email_verified_at'          => 'Email verified at',
        'user_id'                    => 'User id',
        'user_type'                  => 'User type',
        'upload_folder'              => 'Upload folder',
        'deleted_at'                 => 'Deleted at',
        'created_at'                 => 'Created at',
        'updated_at'                 => 'Updated at',
    ],

    
    ];
