<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stationary_kategori extends Model
{
	protected $table = 'stationary_kategory';

	public function scopeJoinStationary_Stock($query)
	{
		return $query->leftjoin('stationery_stock', 'stationery_stock.kode_kategory', '=', 'stationary_kategory.unik_kategory');
	}
}