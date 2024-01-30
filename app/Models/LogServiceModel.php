<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogServiceModel extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'log_service';

    public function penjualan()
    {
        return $this->belongsTo(PenjualanModel::class, 'no_faktur', 'no_faktur');
    }

    public function userCreate()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function penjualanSparePart()
    {
        return $this->hasMany(PenjualanSparePartModel::class, 'no_faktur', 'no_faktur')->with('userCreate');
    }
}
