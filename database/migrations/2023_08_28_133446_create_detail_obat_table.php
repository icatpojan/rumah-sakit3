<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_obat', function (Blueprint $table) {
            $table->id('detail_obat_id');
            $table->integer('regristasi_id');
            $table->integer('obat_id');
            $table->integer('dokter_id')->nullable();

            $table->double('harga_beli')->nullable();
            $table->double('biaya_obat')->nullable();
            $table->double('total_biaya')->nullable();
            $table->double('jumlah');

            $table->enum('status', ['Ralan', 'Ranap'])->nullable();
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
        Schema::dropIfExists('detail_obat');
    }
}
