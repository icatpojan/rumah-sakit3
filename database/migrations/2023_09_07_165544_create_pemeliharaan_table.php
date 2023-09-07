<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeliharaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeliharaan', function (Blueprint $table) {
            $table->id('pemeliharaan_id');
            $table->integer('inventaris_id');
            $table->date('tgl_pemeliharaan');
            $table->string('lama_pemeliharaan');

            $table->string('uraian_kegiatan')->nullable();
            $table->string('pelaksana')->nullable();
            $table->double('biaya')->nullable();
            $table->enum('jenis_pemeliharaan', ['Running Maintenance','Shutdown Maintenance','Emergency Maintenance','Preventive Maintenance'])->nullable();
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
        Schema::dropIfExists('pemeliharaan');
    }
}
