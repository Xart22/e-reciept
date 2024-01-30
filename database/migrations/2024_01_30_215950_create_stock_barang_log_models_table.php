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
        Schema::create('stok_barang_log', function (Blueprint $table) {
            $table->date('tanggal');
            $table->string('kode_barang');
            $table->string('no_faktur')->nullable();
            $table->string('vendor')->nullable();
            $table->bigInteger('in')->nullable();
            $table->bigInteger('out')->nullable();
            $table->bigInteger('saldo');
            $table->longText('keterangan')->nullable();
            $table->bigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_barang_log');
    }
};
