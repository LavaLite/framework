<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TeamTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ( Blueprint $table )
        {
            $table->integer( 'current_team_id' )->unsigned()->nullable();
        } );


        Schema::create('teams', function ( Blueprint $table )
        {
            $table->increments( 'id' )->unsigned();
            $table->integer( 'owner_id' )->unsigned()->nullable();
            $table->string( 'name' );
            $table->timestamps();
        } );

        Schema::create('team_user', function ( Blueprint $table )
        {
            $table->integer( 'user_id' )->unsigned();
            $table->integer( 'team_id' )->unsigned();
            $table->timestamps();

            $table->foreign( 'user_id' )
                ->references('id')
                ->on('users')
                ->onUpdate( 'cascade' )
                ->onDelete( 'cascade' );

            $table->foreign( 'team_id' )
                ->references( 'id' )
                ->on('teams')
                ->onDelete( 'cascade' );
        } );

        Schema::create('team_invites', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->enum('type', ['invite', 'request']);
            $table->string('email');
            $table->string('accept_token');
            $table->string('deny_token');
            $table->timestamps();
            $table->foreign( 'team_id' )
                ->references( 'id' )
                ->on('teams')
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->dropColumn('current_team_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users'.'_user_id_foreign');
            $table->dropForeign('users'.'_team_id_foreign');
        });

        Schema::drop('users');
        Schema::drop('team_invites');
        Schema::drop('teamwork.teams_table');

    }
}
