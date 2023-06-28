<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateTeamsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: teams
         */
        Schema::create('teams', function ($table) {
            $table->id();
            $table->string('name', 30)->nullable();
            $table->string('key', 30)->nullable();
            $table->integer('level')->nullable();
            $table->string('type')->nullable();
            $table->enum('status', ['','Active','Inactive'])->nullable();
            $table->text('description')->nullable();
            $table->text('settings')->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });

        /*
         * Table: users
         */
        Schema::create('team_user', function ($table) {
            $table->id();
            $table->integer('team_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('role')->nullable();
            $table->integer('level')->nullable();
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
        Schema::drop('team_user');
        Schema::drop('teams');
    }
}
