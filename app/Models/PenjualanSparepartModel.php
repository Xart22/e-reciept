<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanSparepartModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'penjualan_sparepart';

    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'no_faktur', 'no_faktur');
    }

    public function barang()
    {
        return $this->belongsTo(StockBarangLogModel::class, 'kode_barang', 'kode_barang');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
