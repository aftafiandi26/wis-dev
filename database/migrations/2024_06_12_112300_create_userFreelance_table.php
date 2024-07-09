<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFreelanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_freelance', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->date('joinDate');
            $table->date('endDate')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->nullable();
            $table->boolean('active')->default(true);
            $table->json('project')->nullable();
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
        Schema::dropIfExists('user_freelance');
    }
}