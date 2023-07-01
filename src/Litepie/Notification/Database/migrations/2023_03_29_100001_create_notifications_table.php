<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

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
        Schema::create('notifications', function ($table) {
            $table->string('id', 50);
            $table->string('type', 250)->nullable();
            $table->string('type_sub', 20)->nullable();
            $table->integer('notifiable_id')->nullable();
            $table->string('notifiable_type', 250)->nullable();
            $table->text('data')->nullable();
            $table->text('message')->nullable();
            $table->text('actions')->nullable();
            $table->string('variant', 20)->nullable();
            $table->tinyInteger('pinned')->nullable();
            $table->dateTime('read_at')->nullable();
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
