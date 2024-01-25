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
            $table->time('waktu');
            $table->string('nama_pelanggan');
            $table->string('nama_perusahaan')->nullable();
            $table->string('alamat_pelanggan');
            $table->string('telepon_pelanggan');
            $table->string('telepon_seluler');
            $table->string('email_pelanggan')->nullable();
            $table->string('item');
            $table->longText('kelengkapan');
            $table->longText('keluhan');
            $table->longText('keterangan_servis')->nullable();
            $table->string('status_barang')->default('Barang diterima');
            $table->string('status_pengambilan')->default('-');
            $table->bigInteger('user_id');
            $table->bigInteger('toko_id');
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
