<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnsToReservationsTable extends Migration
{
    /**
     * visit_statusは来店と未来店で強制キャンセルの管理、payment_statusは決済完了or未完了の管理をするため追加作成
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->enum('visit_status', ['予約中', '来店済み', '強制キャンセル'])->default('予約中')->after('number_of_people');
            $table->enum('payment_status', ['支払い済み', '未払い'])->default('未払い')->after('visit_status');
        });
    }

    public function down()
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('visit_status');
            $table->dropColumn('payment_status');
        });
}
}
