<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWfhChecklistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wfh_checklist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_id')->unique();
            $table->string('document')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('ipaddress');
            $table->string('requester');
            $table->string('job');
            $table->string('location');
            $table->string('device_personal');
            $table->string('device_hostname');
            $table->string('device_isp');
            $table->integer('bandwidth');
            $table->longText('bandwidth_file');
            $table->integer('download');
            $table->integer('upload');
            $table->boolean('net_stat')->default(false);
            $table->integer('vpn03');
            $table->longText('file_vpn03');
            $table->boolean('vpn03_stat')->default(false);
            $table->integer('vpn04');
            $table->longText('file_vpn04');
            $table->boolean('vpn04_stat')->default(false);
            $table->tinyInteger('net_quality')->default(false);
            $table->longText('suges_it')->nullable();
            $table->boolean('confirm')->default(false);
            $table->longText('suges_hrd')->nullable();
            $table->boolean('guest')->default(false);
            $table->boolean('it')->default(false);
            $table->integer('it_by')->nullable();
            $table->dateTime('it_date')->nullable();
            $table->boolean('hr')->default(false);
            $table->integer('hr_by')->nullable();
            $table->dateTime('hr_date')->nullable();
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
        Schema::dropIfExists('wfh_checklist');
    }
}