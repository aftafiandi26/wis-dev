<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus_Transportation extends Model
{
    protected $table = 'bus_transportation';

    public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'bus_transportation.department');
	    }

	public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.id', '=', 'bus_transportation.id_users');
		}

	public function scopeJoinProject_Category($query)
		{
			return $query->leftjoin('project_category', 'project_category.id', '=', 'bus_transportation.project_id');
		}
}
