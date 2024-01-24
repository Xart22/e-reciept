<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TokoModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'toko';

    public function penjualan()
    {
        return $this->hasMany(PenjualanModel::class, 'toko_id');
    }
}
