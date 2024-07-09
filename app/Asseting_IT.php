<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Asseting_IT extends Model
	{
		protected $table = 'asseting_barcode';


		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'asseting_barcode.dept_id');
	    }
	}