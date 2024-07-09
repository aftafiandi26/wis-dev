<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class User_project extends Model
	{
		protected $table = 'user_project';

		public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.id', '=', 'user_project.user_id');
		}

		public function scopeJoinProjCategory1($query)
	    {
	        return $query->leftjoin('project_category', 'user_project.proj1', '=', 'project_category.id');
	    }

	    public function scopeJoinProjCategory2($query)
	    {
	        return $query->leftjoin('project_category', 'user_project.proj2', '=', 'project_category.id');
	    }

	    public function scopeJoinProjCategory3($query)
	    {
	        return $query->leftjoin('project_category', 'user_project.proj3', '=', 'project_category.id');
	    }
	}