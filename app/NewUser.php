<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


	class NewUser extends user
	{
		protected $table = 'users';

		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'users.dept_category_id');
	    }

	    public function scopeJoinProjectCategory1($query)
	    {
	        return $query->leftjoin('project_category', 'project_category.id', '=', 'users.project_category_id_1');
	    }

	    public function scopeJoinProjectCategory2($query)
	    {
	        return $query->leftjoin('project_category', 'project_category.id', '=', 'users.project_category_id_2');
	    }

	    public function scopeJoinProjectCategory3($query)
	    {
	        return $query->leftjoin('project_category', 'project_category.id', '=', 'users.project_category_id_3');
	    }
	     public function scopeJoinLeaveView($query)
	    {
	        return $query->leftjoin('all_leave_entitled', 'all_leave_entitled.nik', '=', 'users.nik');
	    }
	    public function scopeJoinEntitled_leave_view($query)
		{
			return $query->leftjoin('all_leave_entitled', 'all_leave_entitled.nik', '=', 'users.nik');
		}
		/*public function scopeJoinAbsences($query)
		{
			return $query->leftjoin('absences', 'absences.id_user', '=', 'users.id');
		}*/
		public function scopeJoinLeave($query)
		{
			return $query->leftjoin('leave_transaction', 'leave_transaction.user_id', '=', 'users.id');
		}

	}

	