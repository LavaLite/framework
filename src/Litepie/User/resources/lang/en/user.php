<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for user in user package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  user module in user package
    | and it is used by the template/view files in this module
    |
     */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'User',
    'names' => 'Users',
    'icon' => 'las la-list',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Users',
        'sub' => 'Users',
    ],

    /**
     * Singlular and plural name of the module
     */
    'groups' => [
        'main' => 'Main',
        'images' => 'Images',
        'details' => 'Details',
        'settings' => 'Settings',
        'contact' => 'Contact',
        'login' => 'Login Details',
        'company' => 'Company',
        'photo' => 'Photo',
        'roles' => 'Roles',
        'user_login_details' => 'Login details',
        'user_details' => 'User details',
        'photo_gallery' => 'Photo'
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
    'options' => [
        'team_id' =>
        [

            [
                'key' => 10,
                'value' => 10,
                'text' => 10,
            ],

        ],

        'reporting_to' =>
        [

            [
                'key' => 11,
                'value' => 11,
                'text' => 11,
            ],

        ],

        'sex' =>
        [



            [
                'key' => 'Male',
                'value' => 'Male',
                'text' => 'Male',
                'name' => 'Male'
            ],

            [
                'key' => 'Female',
                'value' => 'Female',
                'text' => 'Female',
                'name' => 'Female'
            ],

        ],

        'region' =>
        [

            [
                'key' => 'Yes',
                'value' => 'Yes',
                'text' => 'Yes',
            ],

            [
                'key' => 'No',
                'value' => 'No',
                'text' => 'No',
            ],

        ],

        'status' =>
        [

            [
                'key' => 'New',
                'value' => 'New',
                'text' => 'New',
                'name' => 'New'
            ],

            [
                'key' => 'Active',
                'value' => 'Active',
                'text' => 'Active',
                'name' => 'Active'
            ],
            [
                'key' => 'Inactive',
                'value' => 'Inactive',
                'text' => 'Inactive',
                'name' => 'Inactive'
            ],
        ],
        'user_type' => [
            [
                'key' => 'Admin',
                'value' => 'Admin',
                'text' => 'Admin',
                'name' => 'Admin'
            ],
            [
                'key' => 'Agent',
                'value' => 'Agent',
                'text' => 'Agent',
                'name' => 'Agent'
            ],
        ],
        'status_all' =>
        [
            [
                'key' => '',
                'value' => '',
                'text' => 'All status',
                'name' => 'All status'
            ],
            [
                'key' => 'New',
                'value' => 'New',
                'text' => 'New',
                'name' => 'New'
            ],

            [
                'key' => 'Active',
                'value' => 'Active',
                'text' => 'Active',
                'name' => 'Active'
            ],
            [
                'key' => 'Inactive',
                'value' => 'Inactive',
                'text' => 'Inactive',
                'name' => 'Inactive'
            ],



        ],
        'roles' => [
            [
                'label' => '',
                'options' => [
                    [
                        'key' => '1',
                        'value' => '1',
                        'text' => 'Super user',
                        'name' => 'super user'
                    ],
                    [
                        'key' => '2',
                        'value' => '2',
                        'text' => 'Admin',
                        'name' => 'Admin'
                    ],
                    [
                        'key' => '3',
                        'value' => '3',
                        'text' => 'Agent',
                        'name' => 'Agent'
                    ],
                ]
            ]
        ],
        'user_type_all' => [
            [
                'key' => '',
                'value' => '',
                'text' => 'All user type',
                'name' => 'All user type'
            ],
            [
                'key' => 'Admin',
                'value' => 'Admin',
                'text' => 'Admin',
                'name' => 'Admin'
            ],
            [
                'key' => 'Agent',
                'value' => 'Agent',
                'text' => 'Agent',
                'name' => 'Agent'
            ],
        ],
        'languages' => [
            [
                'key' => 'English',
                'value' => 'English',
                'name' => 'English',
            ],
            [
                'key' => 'Hindi',
                'value' => 'Hindi',
                'name' => 'Hindi',
            ],
            [
                'key' => 'Malayalam',
                'value' => 'Malayalam',
                'name' => 'Malayalam',
            ],
            [
                'key' => 'French',
                'value' => 'French',
                'name' => 'French',
            ],
            [
                'key' => 'Arabic',
                'value' => 'Arabic',
                'name' => 'Arabic',
            ],

        ],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'id' => 'Please enter id',
        'team_id' => 'Please enter team id',
        'reporting_to' => 'Please enter reporting to',
        'name' => 'Please enter name',
        'email' => 'Please enter email',
        'password' => 'Please enter password',
        'current_password' => 'Please enter current password',
        'password_confirmation' => 'Please confirm password',
        'api_token' => 'Please enter api token',
        'remember_token' => 'Please enter remember token',
        'sex' => 'Please select sex',
        'dob' => 'Please select dob',
        'doj' => 'Please select doj',
        'designation' => 'Please enter designation',
        'mobile' => 'Please enter mobile',
        'phone' => 'Please enter phone',
        'address' => 'Please enter address',
        'street' => 'Please enter street',
        'city' => 'Please enter city',
        'region' => 'Please select region',
        'state' => 'Please enter state',
        'country' => 'Please enter country',
        'zipcode' => 'Please enter zipcode',
        'photo' => 'Please enter photo',
        'web' => 'Please enter web',
        'social_urls' => 'Please enter urls',
        'status' => 'Please select status',
        'email_verified_at' => 'Please select email verified at',
        'user_id' => 'Please enter user id',
        'user_type' => 'Please enter user type',
        'upload_folder' => 'Please enter upload folder',
        'deleted_at' => 'Please select deleted at',
        'created_at' => 'Please select created at',
        'updated_at' => 'Please select updated at',
    ],

    /**
     * Labels for inputs.
     */
    'label' => [
        'id' => 'Id',
        'team_id' => 'Team id',
        'reporting_to' => 'Reporting to',
        'name' => 'Name',
        'email' => 'Email',
        'password' => 'Password',
        'current_password' => 'Current password',
        'password_confirmation' => 'Confirm password',
        'api_token' => 'Api token',
        'remember_token' => 'Remember token',
        'sex' => 'Sex',
        'dob' => 'DOB',
        'doj' => 'DOJ',
        'designation' => 'Designation',
        'mobile' => 'Mobile',
        'phone' => 'Phone',
        'address' => 'Address',
        'street' => 'Street',
        'city' => 'City',
        'region' => 'Region',
        'state' => 'State',
        'country' => 'Country',
        'zipcode' => 'Zipcode',
        'photo' => 'Photo',
        'web' => 'Web',
        'social_urls' => 'Social Urls',
        'status' => 'Status',
        'email_verified_at' => 'Email verified at',
        'user_id' => 'User id',
        'user_type' => 'User type',
        'upload_folder' => 'Upload folder',
        'deleted_at' => 'Deleted at',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
        'languages' => 'Languages',
        'type'      => 'Type',
        'languages' => 'Languages',
        'phone' => 'Phone',
        'rera' => 'RERA BRN',
        'education' => 'Education',
        'experience' => 'Experience'

    ],
    'actions' => [
        'create' => [
            'label' => 'Create',
            'icon' => 'material-symbols:add',
            'varient' => 'outline',
        ],
        'list' => [
            'label' => 'Refresh',
            'icon' => 'tabler:refresh',
            'varient' => 'outline',
        ],
        'delete' => [
            'label' => 'Delete',
            'icon' => 'material-symbols:delete-outline',
            'varient' => 'outline',
        ],
    ],

];
