<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('inventaris_id');
            $table->integer('barang_id')->nullable();
            $table->integer('obat_id')->nullable();
            $table->double('harga')->nullable();
            $table->date('tgl_pengadaan')->nullable();
            $table->enum('status', ['ada','rusak','hilang','perbaikan','habis'])->default('ada');
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
        Schema::dropIfExists('inventaris');
    }
}
