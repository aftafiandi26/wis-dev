<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialLeaveExtends extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_leave_extends', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('initial_leave_id');
            $table->integer('user_id');
            $table->date('expired');
            $table->integer('producer_id');
            $table->boolean('ap_producer')->default(false);
            $table->integer('gm_id');
            $table->boolean('ap_gm')->default(false);
            $table->boolean('ver_hr')->default(false);
            $table->bigInteger('create_by');
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
        Schema::dropIfExists('initial_leave_extends');
    }
}