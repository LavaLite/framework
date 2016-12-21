<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'        => 'Message',
    'names'       => 'Messages',
    'user_name'   => 'My <span>Message</span>',
    'user_names'  => 'My <span>Messages</span>',
    'create'      => 'Create My Message',
    'edit'        => 'Update My Message',
    /**
     * Options for select/radio/check.
     */
    'options'     => [
        'status' => ['Draft', 'Inbox', 'Sent', 'Trash', 'Junk', 'Important', 'Promosions', 'Social'],
        'star'   => ['Yes', 'No'],
        'type'   => ['System', 'Admin', 'User'],
        'mails'  => ['1' => 'superuser@superuser.com', '2' => 'admin@admin.com', '3' => 'user@admin.com', '32' => 'anuja@renfos.com'],
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'status'  => 'Please enter status',
        'star'    => 'Please enter star',
        'from'    => 'Please enter from',
        'to'      => 'Please enter to',
        'subject' => 'Please enter subject',
        'message' => 'Please enter message',
        'read'    => 'Please enter read',
        'type'    => 'Please enter type',
    ],

    /**
     * Labels for inputs.
     */
    'label'       => [
        'status'     => 'Status',
        'star'       => 'Star',
        'from'       => 'From',
        'to'         => 'To',
        'subject'    => 'Subject',
        'message'    => 'Message',
        'read'       => 'Read',
        'type'       => 'Type',
        'status'     => 'Status',
        'created_at' => 'Created at',
        'updated_at' => 'Updated at',
    ],

    /**
     * Tab labels
     */
    'tab'         => [
        'name' => 'Name',
    ],

    /**
     * Texts  for the module
     */
    'text'        => [
        'preview' => 'Click on the below list for preview',
    ],
];
