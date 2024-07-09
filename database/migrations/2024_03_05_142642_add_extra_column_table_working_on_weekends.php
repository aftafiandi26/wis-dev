<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtraColumnTableWorkingOnWeekends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('working_on_weekends', function (Blueprint $table) {
            $table->string('extra')->nullable()->after('workStat');
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
            $table->dropColumn('extra');
        });
    }
}
