<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalTable extends Migration
{
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->integer('pegawai_id');
            $table->integer('tahun');
            $table->integer('bulan');
            for ($i = 1; $i <= 31; $i++) {
                $columnName = 'tgl_' . $i;
                $table->string($columnName)->nullable();
            }
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal');
    }
}
