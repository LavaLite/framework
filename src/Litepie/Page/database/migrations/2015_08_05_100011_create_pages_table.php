<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
         * Table: pages
         */
        Schema::create('pages', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('name', 50)->nullable();
            $table->text('title')->nullable();
            $table->text('heading')->nullable();
            $table->text('sub_heading')->nullable();
            $table->text('abstract')->nullable();
            $table->text('content')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->mediumText('banner')->nullable();
            $table->text('images')->nullable();
            $table->enum('compiler', ['php', 'blade', 'none'])->nullable();
            $table->string('view', 20)->nullable();
            $table->integer('order')->nullable();
            $table->string('slug', 200)->nullable();
            $table->enum('status', ['draft', 'published', 'hidden', 'suspended', 'spam'])->default('draft')->nullable();
            $table->string('upload_folder', 100)->nullable();
            $table->integer('user_id')->nullable();
            $table->softDeletes();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
