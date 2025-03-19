<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        /*
         * Table: litepie_user_users
         */
        Schema::table('users', function (Blueprint $table) {
            $table->enum('sex', [null, 'Male', 'Female'])->nullable();
            $table->date('dob')->nullable();
            $table->date('doj')->nullable();
            $table->string('designation', 50)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('street', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('state', 100)->nullable();
            $table->integer('country')->nullable();
            $table->string('photo', 500)->nullable();
            $table->string('web', 100)->nullable();
            $table->string('slug', 50)->nullable();
            $table->longText('social_urls')->nullable();
            $table->enum('status', ['New', 'Active', 'Inactive'])->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type', 50)->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->softDeletes();
        });
    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('sex');
            $table->dropColumn('dob');
            $table->dropColumn('doj');
            $table->dropColumn('designation');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('street');
            $table->dropColumn('city');
            $table->dropColumn('region');
            $table->dropColumn('state');
            $table->dropColumn('country');
            $table->dropColumn('photo');
            $table->dropColumn('web');
            $table->dropColumn('slug');
            $table->dropColumn('social_urls');
            $table->dropColumn('status');
            $table->dropColumn('user_id');
            $table->dropColumn('user_type');
            $table->dropColumn('upload_folder');
        });
    }
}
