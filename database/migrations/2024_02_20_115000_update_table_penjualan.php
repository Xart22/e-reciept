<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->date('service_selesai')->nullable();
            $table->date('pengambilan_barang')->nullable();
        });
        $data = DB::table('penjualan')->get();
        foreach ($data as $item) {
            if ($item->status_service == 'Selesai' || $item->status_service == 'Cancel') {
                DB::table('penjualan')->where('id', $item->id)->update(['service_selesai' => $item->updated_at]);
            }
            if ($item->status_pengambilan == 'Sudah Diambil') {
                DB::table('penjualan')->where('id', $item->id)->update(['pengambilan_barang' => $item->updated_at]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn('status_service');
        });
    }
};
