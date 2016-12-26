<?php

use Illuminate\Database\Migrations\Migration;

class CreateCalendarsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: calendars
         */
        Schema::create('calendars', function ($table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->enum('status', ['Draft', 'Calendar'])->default('Draft');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->string('location', 255)->nullable();
            $table->string('color', 255)->nullable();            
            $table->string('details', 255)->nullable();
            $table->string('created_by', 255)->nullable();
            $table->integer('assignee_id')->nullable();
            $table->string('slug', 200)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type', 100)->nullable();
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
        Schema::drop('calendars');
    }
}
