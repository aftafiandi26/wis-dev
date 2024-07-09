<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendingDataWorkingWeekendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sending_data_working_weekends', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('coor_id');
            $table->integer('count');
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
        Schema::dropIfExists('sending_data_working_weekends');
    }
}