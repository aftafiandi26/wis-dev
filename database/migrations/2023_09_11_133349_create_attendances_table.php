<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('attendances', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->bigInteger('user_id');
        //     $table->boolean('check_in');
        //     $table->boolean('check_out')->default(false);
        //     $table->dateTime('date_in');
        //     $table->dateTime('date_out')->nullable();
        //     $table->bigInteger('count');
        //     $table->text('remarks')->nullable();
        //     $table->string('create');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('attendances');
    }
}