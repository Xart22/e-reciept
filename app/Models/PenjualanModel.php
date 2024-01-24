<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'penjualan';

    public function toko()
    {
        return $this->belongsTo(TokoModel::class, 'toko_id');
    }
}
