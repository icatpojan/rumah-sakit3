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
            $table->id('permohonan_id');
            $table->integer('perbaikan_id');
            $table->date('tgl_permohonan');

            $table->string('deskripsi_kerusakan')->nullable();
            $table->string('pelaksana')->nullable();
            $table->double('biaya')->nullable();
            $table->enum('status', ['sedang diperbaiki','selesai diperbaiki', 'tidak bisa diperbaiki'])->default('sedang diperbaiki');
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
