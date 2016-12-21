<?php

use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: settings
         */
        Schema::create('settings', function ($table) {
            $table->increments('id');
            $table->string('skey', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('value', 255)->nullable();
            $table->enum('type', ['System','Default','User'])->nullable();
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
        Schema::drop('settings');
    }
}
