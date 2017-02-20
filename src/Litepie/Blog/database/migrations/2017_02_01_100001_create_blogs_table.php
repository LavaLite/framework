<?php

use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: blogs
         */
        Schema::create('blogs', function ($table) {
            $table->increments('id');
            $table->integer('category_id')->nullable();
            $table->string('title', 250)->nullable();
            $table->text('details')->nullable();
            $table->text('images')->nullable();
            $table->integer('viewcount')->nullable();
            $table->timestamp('posted_on')->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'complete', 'verify', 'approve', 'publish', 'unpublish', 'archive'])->default('draft')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type',50)->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });

        /*
         * Table: blog_categories
         */
        Schema::create('blog_categories', function ($table) {
            $table->increments('id');
            $table->string('name', 50)->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'complete', 'verify', 'approve', 'publish', 'unpublish', 'archive'])->default('draft')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_type',50)->nullable();
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
        Schema::drop('blog_categories');
        Schema::drop('blogs');
    }
}
