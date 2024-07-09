<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Dept_Category extends Model
	{
		protected $table = 'dept_category';

		public function scopeJoinAsset($query)
	    {
	        return $query->leftjoin('asseting_barcode', 'asseting_barcode.dept_id', '=', 'dept_category.id');
	    }
	}