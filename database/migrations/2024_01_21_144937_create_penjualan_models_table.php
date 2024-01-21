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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->unique();
            $table->date('tanggal');
            $table->string('nama_pelanggan');
            $table->string('alamat_pelanggan');
            $table->string('telepon_pelanggan');
            $table->string('item');
            $table->longText('kelengkapan');
            $table->longText('keluhan');
            $table->longText('keterangan_servis')->nullable();
            $table->string('status_barang')->default('Barang diterima');
            $table->string('status_pengambilan')->default('Belum diambil');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('toko_id')->constrained('toko');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
