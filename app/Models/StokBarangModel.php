<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarangModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'stok_barang';

    public function log()
    {
        return $this->hasMany(StockBarangLogModel::class, 'kode_barang', 'kode_barang');
    }
}
