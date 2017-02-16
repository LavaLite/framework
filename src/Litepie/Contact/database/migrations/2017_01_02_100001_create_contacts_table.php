<?php

use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: contacts
         */
        Schema::create('contacts', function ($table) {
            $table->increments('id');
            $table->string('name', 250)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('mobile', 50)->nullable();
            $table->string('email', 250)->nullable();
            $table->tinyInteger('default')->nullable();
            $table->string('website', 250)->nullable();
            $table->text('details')->nullable();
            $table->string('address_line1', 255)->nullable();
            $table->string('address_line2', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('country', 255)->nullable();
            $table->integer('pin_code')->nullable();
            $table->string('lat', 30)->nullable();
            $table->string('lng', 30)->nullable();
            $table->enum('status', ['Show','Hide'])->nullable();
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
        Schema::drop('contacts');
    }
}
