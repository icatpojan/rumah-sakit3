<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTambahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_tambahan', function (Blueprint $table) {
            $table->id('detail_tambahan_id');
            $table->integer('regristasi_id');
            $table->string('nama_biaya', 60);
            $table->double('total_biaya');
            $table->enum('status', ['ralan', 'ranap']);
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
        Schema::dropIfExists('detail_tambahan');
    }
}
