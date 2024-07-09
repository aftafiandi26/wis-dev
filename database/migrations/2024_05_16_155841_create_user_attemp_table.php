<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attemp', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unique();
            $table->tinyInteger('coor')->default(false);
            $table->tinyInteger('spv')->default(false);
            $table->tinyInteger('pm')->default(false);
            $table->tinyInteger('producer')->default(false);
            $table->tinyInteger('hd')->default(false);
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
        Schema::dropIfExists('user_attemp');
    }
}