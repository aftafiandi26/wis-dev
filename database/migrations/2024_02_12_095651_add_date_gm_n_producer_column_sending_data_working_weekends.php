<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateGmNProducerColumnSendingDataWorkingWeekends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sending_data_working_weekends', function (Blueprint $table) {
            $table->datetime('date_producer')->nullable()->after('ap_producer');
            $table->datetime('date_gm')->nullable()->after('approved');
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
            $table->dropColumn('date_producer');
            $table->dropColumn('date_gm');
        });
    }
}