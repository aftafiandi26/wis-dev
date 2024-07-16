<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDateApprovedExtendofexdoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_leave_extends', function (Blueprint $table) {
            $table->dateTime('date_producer')->nullable()->after('ap_producer');
            $table->dateTime('date_gm')->nullable()->after('ap_gm');
            $table->dateTime('date_hr')->nullable()->after('ver_hr');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_leave_extends', function (Blueprint $table) {
            $table->dropColumn('date_producer');
            $table->dropColumn('date_gm');
            $table->dropColumn('date_hr');
        });
    }
}