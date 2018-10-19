<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for :client in user package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  :client module in user package
    | and it is used by the template/view files in this module
    |
     */

    /*
     * Singlular and plural name of the module
     */
    'name'        => ':Client',
    'names'       => ':Clients',

    /*
     * Singlular and plural name of the module
     */
    'title'       => [
        'main'   => ':Clients',
        'sub'    => ':Clients',
        'list'   => 'List of :clients',
        'edit'   => 'Edit :client',
        'create' => 'Create new :client',
    ],

    /*
     * Options for select/radio/check.
     */
    'options'     => [
        'sex'    => ['', 'male', 'female'],
        'status' => ['New', 'Active', 'Suspended', 'Locked'],
    ],

    /*
     * Placeholder for inputs
     */
    'placeholder' => [
        'id'             => 'Please enter id',
        'name'           => 'Please enter name',
        'email'          => 'Please enter email',
        'password'       => 'Please enter password',
        'api_token'      => 'Please enter api token',
        'remember_token' => 'Please enter remember token',
        'sex'            => 'Please select sex',
        'dob'            => 'Please select dob',
        'mobile'         => 'Please enter mobile',
        'phone'          => 'Please enter phone',
        'address'        => 'Please enter address',
        'street'         => 'Please enter street',
        'city'           => 'Please enter city',
        'district'       => 'Please enter district',
        'state'          => 'Please enter state',
        'country'        => 'Please enter country',
        'photo'          => 'Please enter photo',
        'web'            => 'Please enter web',
        'status'         => 'Please select status',
        'upload_folder'  => 'Please enter upload folder',
        'deleted_at'     => 'Please select deleted at',
        'created_at'     => 'Please select created at',
        'updated_at'     => 'Please select updated at',
    ],

    /*
     * Labels for inputs.
     */
    'label'       => [
        'id'             => 'Id',
        'name'           => 'Name',
        'email'          => 'Email',
        'password'       => 'Password',
        'api_token'      => 'Api token',
        'remember_token' => 'Remember token',
        'sex'            => 'Sex',
        'dob'            => 'Dob',
        'mobile'         => 'Mobile',
        'phone'          => 'Phone',
        'address'        => 'Address',
        'street'         => 'Street',
        'city'           => 'City',
        'district'       => 'District',
        'state'          => 'State',
        'country'        => 'Country',
        'photo'          => 'Photo',
        'web'            => 'Web',
        'status'         => 'Status',
        'upload_folder'  => 'Upload folder',
        'deleted_at'     => 'Deleted at',
        'created_at'     => 'Created at',
        'updated_at'     => 'Updated at',
    ],

    /*
     * Columns array for show hide checkbox.
     */
    'cloumns'     => [
        'name'     => ['name' => 'Name', 'data-column' => 1, 'checked'],
        'email'    => ['name' => 'Email', 'data-column' => 2, 'checked'],
        'sex'      => ['name' => 'Sex', 'data-column' => 3, 'checked'],
        'dob'      => ['name' => 'Dob', 'data-column' => 4, 'checked'],
        'mobile'   => ['name' => 'Mobile', 'data-column' => 5, 'checked'],
        'phone'    => ['name' => 'Phone', 'data-column' => 6, 'checked'],
        'address'  => ['name' => 'Address', 'data-column' => 7, 'checked'],
        'street'   => ['name' => 'Street', 'data-column' => 8, 'checked'],
        'city'     => ['name' => 'City', 'data-column' => 9, 'checked'],
        'district' => ['name' => 'District', 'data-column' => 10, 'checked'],
        'state'    => ['name' => 'State', 'data-column' => 11, 'checked'],
        'country'  => ['name' => 'Country', 'data-column' => 12, 'checked'],
        'photo'    => ['name' => 'Photo', 'data-column' => 13, 'checked'],
        'web'      => ['name' => 'Web', 'data-column' => 14, 'checked'],
    ],

    /*
     * Tab labels
     */
    'tab'         => [
        'name' => ':Clients',
    ],

    /*
     * Texts  for the module
     */
    'text'        => [
        'preview' => 'Click on the below list for preview',
    ],
];
