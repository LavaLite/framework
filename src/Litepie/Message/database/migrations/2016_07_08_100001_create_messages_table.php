<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: messages
         */
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_id')->nullable();
            $table->string('from_type', 225)->nullable();
            $table->string('from_email', 50)->nullable();
            $table->integer('to_id')->nullable();
            $table->string('to_type', 225)->nullable();
            $table->string('to_email', 50)->nullable();
            $table->string('subject', 255)->nullable();
            $table->text('message')->nullable();
            $table->enum('folder', ['Draft','Inbox','Sent','Junk'])->nullable();
            $table->enum('starred', ['Yes','No'])->nullable();
            $table->enum('readed', ['Yes','No'])->nullable();
            $table->mediumText('labels')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type', 255)->nullable();
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
        Schema::drop('messages');
    }
}