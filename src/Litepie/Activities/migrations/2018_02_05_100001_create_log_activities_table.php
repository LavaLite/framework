<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name', 100)->index()->nullable();
            $table->text('description')->nullable();
            $table->integer('subject_id')->index()->nullable();
            $table->string('subject_type', 100)->index()->nullable();
            $table->string('event')->nullable();
            $table->integer('causer_id')->index()->nullable();
            $table->string('causer_type', 100)->index()->nullable();
            $table->text('properties')->nullable();
            $table->uuid('batch_uuid')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('log_activities');
    }
}
