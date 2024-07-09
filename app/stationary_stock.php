<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stationary_stock extends Model
{
    protected $table = 'stationery_stock';

    public function scopeJoinStationary_transaction($query)
		{
			return $query->leftjoin('stationary_transaction', 'stationary_transaction.kode_barang', '=', 'stationery_stock.kode_barang');
		}
	
}
