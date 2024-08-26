<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAttendanceQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_questions', function (Blueprint $table) {
            $table->json('projects')->nullable()->after('Q2');
            $table->string('will_do')->nullable()->after('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_questions', function (Blueprint $table) {
            $table->dropColumn('projects');
            $table->dropColumn('will_do');
        });
    }
}