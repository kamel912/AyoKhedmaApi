<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHolidayIdToObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->unsignedInteger('holiday_id')->after('description')->nullable();
            $table->foreign('holiday_id')->references('id')->on('days');
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
            $table->dropColumn('holiday_id');
        });
    }
}
