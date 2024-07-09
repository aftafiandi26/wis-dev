<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSendingDataWorkingWeekends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sending_data_working_weekends', function (Blueprint $table) {
            $table->integer('producer_id')->after('coor_id');
            $table->boolean('ap_producer')->after('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sending_data_working_weekends', function (Blueprint $table) {
            $table->dropColumn('producer_id');
            $table->dropColumn('ap_producer');
        });
    }
}