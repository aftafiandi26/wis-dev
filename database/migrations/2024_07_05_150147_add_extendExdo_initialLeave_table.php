<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtendExdoInitialLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('initial_leave', function (Blueprint $table) {
            $table->tinyInteger('limiter')->after('expired')->default(1);
            $table->json('attention')->after('note2')->nullable();
            $table->json('attention_by')->after('attention')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('initial_leave', function (Blueprint $table) {
            $table->dropColumn('limiter');
            $table->dropColumn('attention');
            $table->dropColumn('attention_by');
        });
    }
}