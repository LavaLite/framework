<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: permissions
         */
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });

        /*
         * Table: permission_user
         */
        Schema::create('permission_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('permission_id')->unsigned()->index();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        /*
         * Table: permission_role
         */
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->bigInteger('permission_id')->unsigned()->index();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->bigInteger('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::drop('permission_user');
        Schema::drop('permission_role');
        Schema::drop('permissions');
    }
}
