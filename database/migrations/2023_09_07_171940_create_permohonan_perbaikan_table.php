<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanPerbaikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_perbaikan', function (Blueprint $table) {
            $table->id('permohonan_perbaikan_id');
            $table->integer('barang_id');
            $table->integer('pegawai_id');
            $table->date('tgl_permohonan')->nullable();
            $table->string('deskripsi_kerusakan')->nullable();
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
        Schema::dropIfExists('permohonan_perbaikan');
    }
}
