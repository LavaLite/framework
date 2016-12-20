<?php

use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: teams
         */
        Schema::create('teams', function ($table) {
            $table->increments('id');
            $table->string('name', 15)->nullable();
            $table->string('description', 100)->nullable();
            $table->text('settings')->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'complete', 'verify', 'approve', 'publish', 'unpublish', 'archive'])->default('draft')->nullable();
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
        Schema::drop('teams');
    }
}
