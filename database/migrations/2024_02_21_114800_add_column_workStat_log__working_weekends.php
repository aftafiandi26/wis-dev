<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnWorkStatLogWorkingWeekends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log__working_weekends', function (Blueprint $table) {
            $table->string('workStat')->nullable()->after('minutely');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log__working_weekends', function (Blueprint $table) {
            $table->dropColumn('workStat');
        });
    }
}