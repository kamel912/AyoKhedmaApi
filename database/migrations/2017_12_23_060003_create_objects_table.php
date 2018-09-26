<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('beside');
            $table->string('description');
            $table->time('start1');
            $table->time('end1');
            $table->time('start2');
            $table->time('end2');
            $table->time('start3');
            $table->time('end3');
            $table->string('day_off');
            $table->integer('category_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->integer('street_id')->unsigned();
            $table->float('rate')->default('0');
            $table->integer('rate_count')->default('0');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
            $table->foreign('street_id')
                ->references('id')
                ->on('streets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objects');
    }
}
