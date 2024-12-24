<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormStatusLeaveTransactionColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_transaction', function (Blueprint $table) {
            $table->boolean("formStat")->default(true)->after("agreement");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_transaction', function (Blueprint $table) {
            $table->dropColumn("formStat");
        });
    }
}