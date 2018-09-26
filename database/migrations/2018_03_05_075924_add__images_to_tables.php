<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImagesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->string('image')->after('rate_count')->nullable();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->string('image')->after('single_unit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('image');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
}
