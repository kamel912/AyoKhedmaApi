<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->integer('object_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->float('rate');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('object_id')
                ->references('id')
                ->on('objects');
            $table->primary(['user_id','object_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
