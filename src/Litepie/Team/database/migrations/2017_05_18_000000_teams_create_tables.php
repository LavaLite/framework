<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TeamworkSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(\config('teamwork.users_table'), function (Blueprint $table) {
            $table->integer('current_team_id')->unsigned()->nullable();
        });

        Schema::create(\config('teamwork.teams_table'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('owner_id')->unsigned()->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create(\config('teamwork.team_user_table'), function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')
                ->references(\config('teamwork.user_foreign_key'))
                ->on(\config('teamwork.users_table'))
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('team_id')
                ->references('id')
                ->on(\config('teamwork.teams_table'))
                ->onDelete('cascade');
        });

        Schema::create(\config('teamwork.team_invites_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->enum('type', ['invite', 'request']);
            $table->string('email');
            $table->string('accept_token');
            $table->string('deny_token');
            $table->timestamps();
            $table->foreign('team_id')
                ->references('id')
                ->on(\config('teamwork.teams_table'))
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(\config('teamwork.users_table'), function (Blueprint $table) {
            $table->dropColumn('current_team_id');
        });

        Schema::table(\config('teamwork.team_user_table'), function (Blueprint $table) {
            $table->dropForeign(\config('teamwork.team_user_table').'_user_id_foreign');
            $table->dropForeign(\config('teamwork.team_user_table').'_team_id_foreign');
        });

        Schema::drop(\config('teamwork.team_user_table'));
        Schema::drop(\config('teamwork.team_invites_table'));
        Schema::drop(\config('teamwork.teams_table'));
    }
}
