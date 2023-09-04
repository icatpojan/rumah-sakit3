<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id('pegawai_id');
            $table->integer('user_id');
            //info personal
            $table->string('nik', 20);
            $table->string('nama_pegawai', 50);
            $table->enum('jenis_kelamin', ['Pria', 'Wanita']);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('alamat', 60);
            $table->string('image', 500)->nullable();
            $table->enum('golongan_darah', ['A', 'B', 'O', 'AB', '-'])->nullable();
            $table->string('agama', 12)->nullable();
            $table->string('no_telp', 13)->nullable();
            $table->string('email')->nullable();
            $table->enum('status_nikah', ['BELUM MENIKAH', 'MENIKAH', 'JANDA', 'DUDHA', 'JOMBLO'])->nullable();
            //info pendidikan
            $table->string('pendidikan_terakhir', 80)->nullable();
            $table->string('alumni', 60)->nullable();
            //info keuangan dan pajak
            $table->string('bank', 50)->nullable();
            $table->string('rekening', 25)->nullable();
            $table->string('status_wajib_pajak', 5)->nullable();
            $table->string('status_kerja', 3)->nullable();
            $table->enum('status_aktif', ['AKTIF', 'CUTI', 'KELUAR', 'TENAGA LUAR'])->nullable();
            $table->string('npwp', 15)->nullable();
            $table->integer('gaji_pokok')->nullable();
            //informasi pekerjaan
            $table->string('departemen_id', 4);
            $table->string('bidang', 15)->nullable();
            $table->string('jabatan', 25)->nullable();
            $table->string('jenjang_jabatan', 5)->nullable();
            $table->string('kode_kelompok', 3)->nullable();
            $table->string('kode_resiko', 3)->nullable();
            $table->string('kode_emergency', 3)->nullable();
            //informasi kontrak
            $table->date('mulai_kontrak')->nullable()->nullable();
            $table->date('mulai_kerja')->nullable();
            $table->enum('masa_kerja', ['<1', 'PT', 'FT>1'])->nullable();
            $table->string('indexins', 4)->nullable();
            $table->integer('wajibmasuk')->nullable();
            $table->integer('pengurang')->nullable();
            $table->integer('indek')->nullable();
            $table->integer('cuti_diambil')->nullable();
            $table->integer('dankes')->nullable();
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
        Schema::dropIfExists('pegawai');
    }
}
