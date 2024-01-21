<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan_sparepart', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->constrained('penjualan');
            $table->string('kode_barang')->constrained('stok_barang');
            $table->bigInteger('jumlah_barang');
            $table->string('harga_barang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan_sparepart');
    }
};
