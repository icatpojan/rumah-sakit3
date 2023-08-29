<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerawatanTable extends Migration
{
    public function up()
    {
        Schema::create('perawatan', function (Blueprint $table) {
            $table->id('perawatan_id', 15);
            $table->integer('poliklinik_id');
            $table->string('nama_perawatan', 80);

            $table->double('bagian_rs')->nullable();
            $table->double('bhp')->nullable();
            $table->double('tarif_perujuk')->nullable();
            $table->double('tarif_tindakan_dokter')->nullable();
            $table->double('tarif_tindakan_petugas')->nullable();
            $table->double('kso')->nullable();
            $table->double('menejemen')->nullable();
            $table->double('total_biaya')->nullable();

            $table->char('kode_pj', 3)->nullable();
            $table->enum('status', ['0', '1'])->nullable();
            $table->enum('kelas', ['-', 'Rawat Jalan', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas Utama', 'Kelas VIP', 'Kelas VVIP'])->nullable();
            $table->enum('kategori', ['PK', 'PA', 'MB'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perawatan');
    }
}
