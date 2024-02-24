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

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function userUpdate()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function sales()
    {
        return $this->belongsTo(User::class, 'sales_id');
    }


    public function sparePart()
    {
        return $this->hasMany(PenjualanSparePartModel::class, 'no_faktur', 'no_faktur')->with('userCreate');
    }

    function log()
    {
        return $this->hasMany(LogServiceModel::class, 'no_faktur', 'no_faktur')->with('userCreate');
    }
}
