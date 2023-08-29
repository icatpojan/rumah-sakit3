<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail', function (Blueprint $table) {
            $table->id('detail_id');
            $table->integer('regristasi_id');
            $table->string('perawatan_id', 15);
            $table->string('dokter_id', 20);
            $table->date('tgl_perawatan');
            $table->time('jam_rawat');

            $table->double('bagian_rs')->nullable();
            $table->double('bhp')->nullable();
            $table->double('tarif_perujuk')->nullable();
            $table->double('tarif_tindakan_dokter')->nullable();
            $table->double('tarif_tindakan_petugas')->nullable();
            $table->double('kso')->nullable();
            $table->double('menejemen')->nullable();
            $table->double('total_biaya')->nullable();

            $table->enum('status_bayar', ['sudah', 'belum', 'suspen'])->nullable();
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
        Schema::dropIfExists('detail');
    }
}
