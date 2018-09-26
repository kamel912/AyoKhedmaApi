<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArabicNamesToDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('days', function (Blueprint $table) {
            $table->string('arabic_name')->after('short_name')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('days', function (Blueprint $table) {
            $table->dropColumn('arabic_name');
        });
    }
}
