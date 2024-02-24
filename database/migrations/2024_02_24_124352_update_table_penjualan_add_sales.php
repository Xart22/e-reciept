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
            $table->bigInteger('sales_id');
        });
        $data = DB::table('penjualan')->get();
        foreach ($data as $item) {
            DB::table('penjualan')->where('id', $item->id)->update(['sales_id' => $item->created_by]);
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
