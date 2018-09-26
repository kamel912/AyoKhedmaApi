<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionIdToStreetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('streets', function (Blueprint $table) {
            $table->unsignedInteger('region_id')->after('name');

            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('streets', function (Blueprint $table) {
            $table->dropColumn('region_id');
        });
    }
}
