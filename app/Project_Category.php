<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Project_Category extends Model
	{
		protected $table = 'project_category';

		public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.project_category_id_1', '=', 'project_category.id');
		}
	}