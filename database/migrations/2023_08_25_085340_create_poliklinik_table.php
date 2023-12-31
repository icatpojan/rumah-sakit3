<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliklinikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poliklinik', function (Blueprint $table) {
            $table->id('poliklinik_id');
            $table->string('nama_poliklinik');
            $table->integer('regristasi_baru')->nullable();
            $table->integer('regristasi_lama')->nullable();
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
        Schema::dropIfExists('poliklinik');
    }
}
