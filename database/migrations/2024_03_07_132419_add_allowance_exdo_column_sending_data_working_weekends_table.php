<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowanceExdoColumnSendingDataWorkingWeekendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sending_data_working_weekends', function (Blueprint $table) {
            $table->boolean('exdo')->default(false)->after('approved');
            $table->boolean('allowance')->default(false)->after('exdo');
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
            $table->dropColumn('exdo');
            $table->dropColumn('allowance');
        });
    }
}
