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

    public function setting()
    {
        return $this->hasOne(SettingModel::class, 'toko_id');
    }
}
