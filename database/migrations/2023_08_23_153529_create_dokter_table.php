<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokterTable extends Migration
{
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->id('dokter_id');
            $table->integer('pegawai_id');
            $table->char('kode_spesialis', 5)->nullable();
            $table->string('no_ijn_praktek', 120)->nullable();
            $table->enum('status', ['0', '1'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dokter');
    }
}
