<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->foreignId('barang_id')->constrained('barangs');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->timestamps();
            $table->foreign('kode_transaksi')->references('kode_transaksi')->on('transaksis');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksis');
    }
}
