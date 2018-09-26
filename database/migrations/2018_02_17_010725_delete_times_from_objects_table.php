<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteTimesFromObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('start1','end1','start2','end2','start3','end3');
            $table->renameColumn('day_off', 'holiday_id');
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
            $table->time('start1');
            $table->time('end1');
            $table->time('start2');
            $table->time('end2');
            $table->time('start3');
            $table->time('end3');

            $table->renameColumn('holiday_id', 'day_off');
        });
    }
}
