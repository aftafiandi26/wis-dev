<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationeryMineralPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('stationery__mineral__purchases', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->integer('kode_barang');
        //     $table->boolean('key_param')->default(true);
        //     $table->string('pr')->unique();
        //     $table->integer('qty_box')->default(0);
        //     $table->integer('qty_pcs')->default(0);
        //     $table->integer('qty_total')->default(0);
        //     $table->integer('price_box')->default(0);
        //     $table->integer('price_pcs')->default(0);
        //     $table->integer('price_total')->default(0);
        //     $table->text('remarks')->nullable();
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
        // Schema::dropIfExists('stationery__mineral__purchases');
    }
}