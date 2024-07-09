<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Asseting_PS extends Model
	{
		protected $table = 'asseting_barcode_ps';


		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'asseting_barcode.dept_id');
	    }
	}