<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogActionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('log_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 100)->nullable()->index();
            $table->integer('subject_id')->nullable()->index();
            $table->string('subject_type', 100)->nullable()->index();
            $table->integer('causer_id')->nullable()->index();
            $table->string('causer_type', 100)->nullable()->index();
            $table->text('description')->nullable();
            $table->text('property')->nullable();
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
