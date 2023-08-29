<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->id('presensi_id');
            $table->integer('pegawai_id');
            $table->integer('shift_id');
            $table->date('tanggal');
            $table->integer('waktu_keterlambatan')->nullable();
            $table->integer('waktu_kecepetan')->nullable();
            $table->string('status');
            $table->string('lat')->nullable();
            $table->string('lon')->nullable();
            $table->string('keterangan'); // pulang atau datang
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
        Schema::dropIfExists('presensi');
    }
}
