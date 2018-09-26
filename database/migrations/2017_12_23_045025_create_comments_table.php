<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('object_id')->unsigned();
            $table->string('subject');
            $table->string('body');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('object_id')
                ->references('id')
                ->on('objects');
            $table->primary(['id','user_id','object_id']);
        });

        Schema::table('comments', function (Blueprint $table) {
            DB::statement('ALTER TABLE comments MODIFY id INTEGER NOT NULL AUTO_INCREMENT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
