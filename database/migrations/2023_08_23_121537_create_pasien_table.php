<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasienTable extends Migration
{
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id('pasien_id');
            $table->integer('user_id');
            // Informasi Identitas Pasien
            $table->string('nama_pasien', 40);
            $table->string('nik', 20);
            $table->string('image', 40)->nullable();
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->string('tmp_lahir', 15)->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('nm_ibu', 40)->nullable();
            // Informasi Alamat dan Kontak
            $table->string('alamat', 200)->nullable();
            $table->enum('gol_darah', ['A', 'B', 'O', 'AB', '-'])->nullable();
            $table->string('pekerjaan', 60)->nullable();
            $table->enum('status_nikah', ['belum menikah', 'menikah'])->nullable();
            $table->string('agama', 12)->nullable();
            $table->date('tgl_daftar')->nullable();
            $table->string('no_tlp', 40)->nullable();
            $table->string('umur', 30)->nullable();
            // Informasi Pendidikan dan Keluarga
            $table->enum('pnd', ['TS', 'TK', 'SD', 'SMP', 'SMA', 'SLTA/SEDERAJAT', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3', '-'])->nullable();
            $table->enum('keluarga', ['AYAH', 'IBU', 'ISTRI', 'SUAMI', 'SAUDARA', 'ANAK'])->nullable();
            $table->string('namakeluarga', 50)->nullable();
            // Informasi Penanggung Jawab
            $table->char('penjamin', 100)->nullable();
            $table->string('no_peserta', 25)->nullable();
            $table->integer('kd_kelurahan')->nullable();
            $table->integer('kd_kec')->nullable();
            $table->integer('kd_kab')->nullable();
            $table->string('pekerjaanpj', 35)->nullable();
            $table->string('alamatpj', 100)->nullable();
            $table->string('kelurahanpj', 60)->nullable();
            $table->string('kecamatanpj', 60)->nullable();
            $table->string('kabupatenpj', 60)->nullable();
            // Informasi Lainnya
            $table->string('perusahaan_pasien', 8)->nullable();
            $table->integer('suku_bangsa')->nullable();
            $table->integer('bahasa_pasien')->nullable();
            $table->integer('cacat_fisik')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('nip', 30)->nullable();
            $table->integer('kd_prop')->nullable();
            $table->string('propinsipj', 30)->nullable();
            // Waktu pembuatan dan pembaruan rekaman
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
