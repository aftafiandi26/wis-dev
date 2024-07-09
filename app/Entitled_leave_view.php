<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Entitled_leave_view extends Model
	{
		protected $table = 'all_leave_entitled';

		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'all_leave_entitled.dept_category_id');
	    }
	    public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.nik', '=', 'all_leave_entitled.nik');
		}
	}