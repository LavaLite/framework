<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateActionLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->index();
            $table->integer('subject_id')->nullable();
            $table->string('subject_type', 100)->nullable();
            $table->integer('causer_id')->nullable();
            $table->string('causer_type', 100)->nullable();
            $table->string('action', 100)->nullable();
            $table->text('description');
            $table->text('properties')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('log_actions');
    }
}
