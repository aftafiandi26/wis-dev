<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationeryHistory extends Model
{
    protected $table = 'stationary_historical';

    public function scopeJoinStatiioneryStock($query)
    {
        return $query->leftjoin('stationery_stock', 'stationery_stock.kode_barang', '=', 'stationary_historical.kode_barang');
    }
}
