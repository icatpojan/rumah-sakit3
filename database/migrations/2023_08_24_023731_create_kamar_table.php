<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarTable extends Migration
{
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id('kamar_id');
            $table->integer('bangsal_id');
            $table->double('tarif_kamar')->nullable();
            $table->enum('status', ['ISI', 'KOSONG', 'DIBERSIHKAN', 'DIBOOKING'])->nullable();
            $table->enum('kelas', ['Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas Utama', 'Kelas VIP', 'Kelas VVIP'])->nullable();
            $table->enum('statusdata', ['0', '1'])->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kamar');
    }
}
