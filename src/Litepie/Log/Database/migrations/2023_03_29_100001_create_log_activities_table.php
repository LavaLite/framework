<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLogActivitiesTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: log_activities
         */
        Schema::create('activity_log', function ($table) {
            $table->bigIncrements('id');
            $table->string('log_name', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('subject_type', 100)->nullable();
            $table->string('event')->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type', 100)->nullable();
            $table->text('properties')->nullable();
            $table->uuid('batch_uuid')->nullable();
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
        Schema::drop('activity_log');
    }
}
