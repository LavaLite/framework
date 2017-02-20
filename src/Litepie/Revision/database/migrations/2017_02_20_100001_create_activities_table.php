<?php

use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('activities', function ($table) {
            $table->increments('id');
            $table->string('action', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('activity_type', 255)->nullable();
            $table->integer('activity_id')->nullable();
            $table->text('user_info')->nullable();
            $table->string('slug', 200)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type',50)->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /*
    * Reverse the migrations.
    *
    * @return void
    */

    public function down()
    {
        Schema::drop('activities');
    }
}
