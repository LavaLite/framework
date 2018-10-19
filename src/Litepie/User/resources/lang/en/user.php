<?php

return [

    /*
     * Singlular and plural name of the module
     */
    'name'                  => 'User',
    'names'                 => 'Users',
    'updated'               => 'Profile updated',
    'user'                  => 'User',

    /*
     * Options for select/radio/check.
     */
    'options'               => [
        'sex'          => [
            'male'   => ['name' => 'sex', 'value' => 'male'],
            'female' => ['name' => 'sex', 'value' => 'female'],
        ],
        'status'          => ['New'=>'New', 'Active'=>'Active', 'Suspended'=>'Suspended'],
        'reporting_to'    => ['1'],
        'department'      => ['marketing' => 'Marketing', 'accounts' => 'Accounts', 'store' => 'Store'],
    ],

    /*
     * Placeholder for inputs
     */
    'placeholder'           => [
        'reporting_to'              => 'Select',
        'email'                     => 'Enter E-mail Address',
        'name'                      => 'Enter Name',
        'department'                => 'Department',
        'password'                  => 'Enter Password',
        'password_confirmation'     => 'Re-enter Password',
        'current_password'          => 'Please enter current password',
        'new_password'              => 'Please new password',
        'new_password_confirmation' => 'Please enter new password again',
        'first_name'                => 'Enter First Name',
        'last_name'                 => 'Enter Last Name',
        'sex'                       => 'Select sex',
        'date_of_birth'             => 'Enter Date of Birth',
        'photo'                     => 'Photo',
        'mobile'                    => 'Enter Mobile',
        'phone'                     => 'Enter Phone',
        'address'                   => 'Enter Address',
        'street'                    => 'Enter Street',
        'city'                      => 'Enter City',
        'district'                  => 'Enter District',
        'activated'                 => 'Active',
        'type'                      => 'Type',
        'dob'                       => 'Date of Birth',
        'designation'               => 'Designation',
        'state'                     => 'Enter State',
        'country'                   => 'Enter Country',
        'web'                       => 'Enter Web',
        'minutes'                   => 'Minutes',
    ],

    /*
     * Labels for inputs.
     */
    'label'                 => [
        'activated'                 => 'Active',
        'address'                   => 'Address',
        'city'                      => 'City',
        'country'                   => 'Country',
        'current_password'          => 'Current password',
        'date_of_birth'             => 'Date of Birth',
        'department'                => 'Department',
        'designation'               => 'Designation',
        'designation'               => 'Designation',
        'district'                  => 'District',
        'dob'                       => 'Date of Birth',
        'email'                     => 'E-mail Address',
        'first_name'                => 'First Name',
        'last_name'                 => 'Last Name',
        'login'                     => 'Login',
        'minutes'                   => 'Duration',
        'mobile'                    => 'Mobile',
        'name'                      => 'Name',
        'new_password'              => 'New Password',
        'new_password_confirmation' => 'Confirm New Password',
        'password'                  => 'Password',
        'password_confirmation'     => 'Confirm Password',
        'phone'                     => 'Phone',
        'photo'                     => 'Photo',
        'reporting_to'              => 'Reporting to',
        'sex'                       => 'Sex',
        'state'                     => 'State',
        'status'                    => 'Status',
        'street'                    => 'Street',
        'type'                      => 'Type',
        'web'                       => 'Web',
    ],

    /*
     * Tab labels
     */
    'tab'                   => [
        'name' => 'Name',
    ],

    /*
     * Texts  for the module
     */
    'text'                  => [
        'preview' => 'Click on the below list for preview',
    ],
];
