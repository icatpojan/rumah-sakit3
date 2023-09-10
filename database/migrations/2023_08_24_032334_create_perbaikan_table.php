<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->id('perbaikan_id');
            $table->integer('permohonan_perbaikan_id');
            $table->string('pelaksana')->nullable();
            $table->date('tgl_perbaikan')->nullable();
            $table->string('lama_perbaikan')->nullable();
            $table->string('uraian_kegiatan')->nullable();
            $table->double('biaya')->nullable();
            $table->enum('status', ['0','1'])->nullable();
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
        Schema::dropIfExists('perbaikan');
    }
}
