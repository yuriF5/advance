<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropBusinessHoursAndBookingFromShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            // カラムを削除します
            $table->dropColumn('business_hours');
            $table->dropColumn('booking');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            // カラムを元に戻します
            $table->unsignedTinyInteger('business_hours')->nullable();
            $table->time('booking')->nullable();
        });
    }
}
