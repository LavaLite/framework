<?php

use Illuminate\Database\Seeder;

class TaskTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tasks')->insert([

            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'parent_id'     => null,
                'start'         => null,
                'end'           => null,
                'category'      => null,
                'task'          => 'testing',
                'time_required' => null,
                'time_taken'    => null,
                'priority'      => null,
                'status'        => 'completed',
                'created_by'    => null,
                'assigned_to'   => null,
                'slug'          => 'testing',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-19 11:43:26',
                'updated_at'    => '2016-07-19 11:43:58',
            ],
            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'parent_id'     => null,
                'start'         => null,
                'end'           => null,
                'category'      => null,
                'task'          => 'developing',
                'time_required' => null,
                'time_taken'    => null,
                'priority'      => null,
                'status'        => 'to_do',
                'created_by'    => null,
                'assigned_to'   => null,
                'slug'          => 'developing',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-19 11:43:38',
                'updated_at'    => '2016-07-19 11:43:38',
            ],
            [
                'user_id'       => '1',
                'user_type'     => 'App\\User',
                'parent_id'     => null,
                'start'         => null,
                'end'           => null,
                'category'      => null,
                'task'          => 'designing',
                'time_required' => null,
                'time_taken'    => null,
                'priority'      => null,
                'status'        => 'in_progress',
                'created_by'    => null,
                'assigned_to'   => null,
                'slug'          => 'designing',
                'upload_folder' => null,
                'deleted_at'    => null,
                'created_at'    => '2016-07-19 11:43:53',
                'updated_at'    => '2016-07-19 11:43:56',
            ],

        ]);

        DB::table('menus')->insert([

            [
                'parent_id'   => 1,
                'key'         => null,
                'url'         => 'admin/task/task',
                'name'        => 'Tasks',
                'description' => null,
                'icon'        => 'fa fa-flag-o',
                'target'      => null,
                'order'       => 220,
                'status'      => 1,
            ],

            [
                'parent_id'   => 2,
                'key'         => null,
                'url'         => 'user/task/task',
                'name'        => 'Tasks',
                'description' => null,
                'icon'        => 'pe-7s-id',
                'target'      => null,
                'order'       => 220,
                'status'      => 1,
            ],

            [
                'parent_id'   => 3,
                'key'         => null,
                'url'         => 'client/task/task',
                'name'        => 'Task',
                'description' => null,
                'icon'        => 'pe-7s-id',
                'target'      => null,
                'order'       => 220,
                'status'      => 1,
            ],

        ]);

        DB::table('permissions')->insert([
            [
                'slug' => 'task.task.view',
                'name' => 'View Task',
            ],
            [
                'slug' => 'task.task.create',
                'name' => 'Create Task',
            ],
            [
                'slug' => 'task.task.edit',
                'name' => 'Update Task',
            ],
            [
                'slug' => 'task.task.delete',
                'name' => 'Delete Task',
            ],
        ]);

        DB::table('settings')->insert([
            // Uncomment  and edit this section for entering value to settings table.
            /*
        [
        'key'      => 'task.task.key',
        'name'     => 'Some name',
        'value'    => 'Some value',
        'type'     => 'Default',
        ],
         */
        ]);
    }
}
