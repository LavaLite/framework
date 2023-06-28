<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLogActionsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: log_actions
         */
        Schema::create('log_actions', function ($table) {
            $table->id();
            $table->string('action', 100)->nullable();
            $table->string('description', 100)->nullable();
            $table->integer('subject_id')->nullable();
            $table->string('subject_type', 100)->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type', 100)->nullable();
            $table->string('transition', 30)->nullable();
            $table->time('duration')->nullable();
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
        Schema::drop('log_actions');
    }
}
