<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockBarangLogModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'stok_barang_log';

    public function stokBarang()
    {
        return $this->belongsTo(StokBarangModel::class, 'kode_barang', 'kode_barang');
    }
}
