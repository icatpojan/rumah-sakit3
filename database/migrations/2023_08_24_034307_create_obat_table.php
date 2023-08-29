<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id('obat_id');
            $table->string('nama_obat', 80)->nullable();
            $table->double('dasar');

            $table->double('harga_beli')->nullable();
            $table->double('ralan')->nullable();
            $table->double('harga_kelas_1')->nullable();
            $table->double('harga_kelas_2')->nullable();
            $table->double('harga_kelas_3')->nullable();
            $table->double('harga_utama')->nullable();
            $table->double('harga_vip')->nullable();
            $table->double('harga_vvip')->nullable();
            $table->double('harga_beli_luar')->nullable();
            $table->double('harga_jual_bebas')->nullable();
            $table->double('harga_karyawan')->nullable();
            
            $table->double('stok_minimal')->nullable();
            $table->double('stok')->nullable();
            $table->date('expire')->nullable();
            $table->enum('status', ['0', '1']);
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
        Schema::dropIfExists('obat');
    }
}
