<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Meeting extends Model
	{
		protected $table = 'meeting';

		public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.id', '=', 'meeting.user_id');
		}


		public function scopeJoinProject($query)
	    {
	        return $query->leftjoin('project_category', 'project_category.id', '=', 'meeting.Project');
	    }



	}