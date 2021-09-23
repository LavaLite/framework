<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: notifications
         */
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 255)->nullable();
            $table->integer('notifiable_id')->nullable();
            $table->string('notifiable_type', 255)->nullable();
            $table->text('data')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'complete', 'verify', 'approve', 'publish', 'unpublish', 'archive'])->default('draft')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type', 50)->nullable();
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
        Schema::drop('notifications');
    }
}
