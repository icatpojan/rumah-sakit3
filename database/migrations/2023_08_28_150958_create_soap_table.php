<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soap', function (Blueprint $table) {
            $table->id('soap_id');
            $table->integer('pasien_id');
            $table->integer('regristasi_id');
            $table->date('tgl_perawatan')->nullable();
            $table->time('jam_rawat')->nullable();
            $table->string('suhu_tubuh', 5)->nullable();
            $table->string('tensi', 8);
            $table->string('nadi', 3)->nullable();
            $table->string('respirasi', 3)->nullable();
            $table->string('tinggi', 5)->nullable();
            $table->string('berat', 5)->nullable();
            $table->string('spo2', 3)->nullable();
            $table->string('gcs', 10)->nullable();
            $table->enum('kesadaran', ['Compos Mentis', 'Somnolence', 'Sopor', 'Coma'])->nullable();
            $table->string('keluhan', 2000)->nullable();
            $table->string('pemeriksaan', 2000)->nullable();
            $table->string('alergi', 50)->nullable();
            $table->string('lingkar_perut', 5)->nullable();
            $table->string('rtl', 2000)->nullable();
            $table->string('penilaian', 2000)->nullable();
            $table->string('instruksi', 2000)->nullable();
            $table->string('evaluasi', 2000)->nullable();
            $table->string('nip', 20)->nullable();
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
        Schema::dropIfExists('soap');
    }
}
