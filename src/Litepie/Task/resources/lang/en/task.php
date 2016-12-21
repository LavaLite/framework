<?php

return [

    /**
     * Singlular and plural name of the module
     */
    'name'        => 'Task',
    'names'       => 'Tasks',
    'user_name'   => 'My <span>Task</span>',
    'user_names'  => 'My <span>Tasks</span>',
    'create'      => 'Create My Task',
    'edit'        => 'Update My Task',

    /**
     * Options for select/radio/check.
     */
    'options'     => [

        'status'=>[   
                'to_do' => 'To do',
                'in_progress' => 'In progress'  ,     
                'completed' =>'Completed',      
                 ],
        'priority'=>[   
                'Critical' => 'Critical',
                'High' => 'High',
                'Normal' => 'Normal',
                'Low' => 'Low',
                'Minor' => 'Minor',    
                 ]
    ],

    /**
     * Placeholder for inputs
     */
    'placeholder' => [
        'parent_id'     => 'Please enter parent',
        'start'         => 'Please enter date',
        'end'           => 'Please enter end',
        'category'      => 'Please enter category',
        'task'          => 'Please enter task',
        'description'   => 'Please enter description',
        'time_required' => 'Please enter time required',
        'time_taken'    => 'Please enter time taken',
        'priority'      => 'Please enter priority',
        'status'        => 'Please enter status',
        'created_by'    => 'Please enter created by',
        'assigned_to'   => 'Please enter assigned to',
    ],

    /**
     * Labels for inputs.
     */
    'label'       => [
        'parent_id'     => 'Parent id',
        'start'         => 'Date',
        'end'           => 'End',
        'category'      => 'Category',
        'task'          => 'Task',
        'description'   => 'Description',
        'time_required' => 'Time required',
        'time_taken'    => 'Time taken',
        'priority'      => 'Priority',
        'status'        => 'Status',
        'created_by'    => 'Created by',
        'status'        => 'Status',
        'created_at'    => 'Created at',
        'assigned_to'    => 'Assigned to',
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
