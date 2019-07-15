<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Language files for team in teams package
    |--------------------------------------------------------------------------
    |
    | The following language lines are  for  team module in teams package
    | and it is used by the template/view files in this module
    |
     */

    /**
     * Singlular and plural name of the module
     */
    'name' => 'Team',
    'names' => 'Teams',

    /**
     * Singlular and plural name of the module
     */
    'title' => [
        'main' => 'Teams',
        'sub' => 'Teams',
        'list' => 'List of teams',
        'edit' => 'Edit team',
        'create' => 'Create new team',
    ],

    /**
     * Options for select/radio/check.
     */
    'options' => [
        'role' => ['Admin' => 'Admin', 'Manager' => 'Manager', 'User' => 'User'],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'id' => '',
        'name' => 'Please enter name',
        'team_id' => 'Team',
        'user_id' => 'User',
        'role' => 'Role',
    ],

    /**
     * Labels for inputs.
     */
    'label' => [
        'id' => '',
        'name' => 'Name',
        'team_id' => 'Team',
        'user_id' => 'User',
        'role' => 'Role',
    ],

    /**
     * Columns array for show hide checkbox.
     */
    'cloumns' => [
        'name' => ['name' => 'Name', 'data-column' => 1, 'checked'],
    ],

    /**
     * Tab labels
     */
    'tab' => [
        'name' => 'Teams',
    ],

    /**
     * Texts  for the module
     */
    'text' => [
        'preview' => 'Click on the below list for preview',
    ],
];
