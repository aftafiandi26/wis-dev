<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDateProducerNGmWorkingOnWeekends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('working_on_weekends', function (Blueprint $table) {
            $table->dateTime('date_producer')->nullable()->after('ap_producer');
            $table->dateTime('date_gm')->nullable()->after('approved');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('working_on_weekends', function (Blueprint $table) {
            $table->dropColumn('date_producer');
            $table->dropColumn('date_gm');
        });
    }
}