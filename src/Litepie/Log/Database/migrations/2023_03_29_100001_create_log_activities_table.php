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
        Schema::create('log_activities', function ($table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('subject_type', 100)->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type', 100)->nullable();
            $table->text('properties')->nullable();
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
        Schema::drop('log_activities');
    }
}
