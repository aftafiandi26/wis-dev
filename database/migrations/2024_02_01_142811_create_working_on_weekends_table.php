<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkingOnWeekendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_on_weekends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coor_id');
            $table->integer('user_id');
            $table->string('project')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('hourly');
            $table->integer('minutely');
            $table->integer('status');
            $table->boolean('approved')->default(false);
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
        Schema::dropIfExists('working_on_weekends');
    }
}