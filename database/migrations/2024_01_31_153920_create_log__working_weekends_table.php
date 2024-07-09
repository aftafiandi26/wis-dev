<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogWorkingWeekendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log__working_weekends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coor_id');
            $table->integer('user_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('hourly');
            $table->integer('minutely');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log__working_weekends');
    }
}