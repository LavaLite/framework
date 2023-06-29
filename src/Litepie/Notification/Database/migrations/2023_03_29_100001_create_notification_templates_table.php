<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateNotificationTemplatesTable extends Migration
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
        Schema::create('notification_templates', function ($table) {
            $table->id();
            $table->string('key', 250)->nullable();
            $table->string('language', 3)->default('en')->nullable();
            $table->string('subject', 100)->nullable();
            $table->text('message')->nullable();
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
        Schema::drop('notification_templates');
    }
}
