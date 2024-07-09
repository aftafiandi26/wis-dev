<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PolingKantin extends Model
{
   protected $table = 'voting_canteen';

		public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.id', '=', 'voting_canteen.id_userss');
		}

		public function scopeJoinDeptCategory($query)
		{
			return $query->leftjoin('dept_category', 'dept_category.id', '=', 'users.dept_category_id');
		}
}
