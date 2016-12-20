<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('name');
            $table->longText('permissions')->nullable();
            $table->timestamps();
        });
        
        Schema::create('roleables', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->index();
            $table->integer('roleable_id')->unsigned()->index();
            $table->string('roleable_type', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('roles');
        Schema::drop('roleables');
    }
}
