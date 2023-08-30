<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegristasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regristasi', function (Blueprint $table) {
            $table->id('regristasi_id');
            $table->integer('dokter_id');
            $table->integer('pasien_id');
            $table->string('no_regristasi', 50)->nullable();
            $table->date('tgl_registrasi')->nullable();
            $table->time('jam_reg')->nullable();
            $table->integer('poliklinik_id');
            $table->string('penjamin', 100);
            $table->string('alamat_pj', 200)->nullable();
            $table->string('hubungan_pj', 20)->nullable();
            $table->double('biaya_regristasi')->nullable();
            $table->enum('status', ['belum', 'sudah', 'batal', 'berkas Diterima', 'dirujuk', 'meninggal', 'dirawat', 'pulang paksa'])->default('belum');
            $table->enum('status_bayar', ['sudah', 'belum'])->default('belum');
            $table->enum('status_daftar', ['lama', 'baru'])->default('baru');
            $table->enum('status_lanjut', ['ralan', 'ranap'])->default('ralan');
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
        Schema::dropIfExists('regristasi');
    }
}
