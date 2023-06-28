<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CreateMastersTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {

        /*
         * Table: masters
         */
        Schema::create('masters', function ($table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('type', 50)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('code', 20)->nullable();
            $table->double('amount', 10,2)->nullable();
            $table->string('abbr', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('icon', 50)->nullable();
            $table->text('image')->nullable();
            $table->text('images')->nullable();
            $table->text('file')->nullable();
            $table->integer('order')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->text('extras')->nullable();
            $table->string('slug', 255)->nullable();
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
        Schema::drop('masters');
    }
}
