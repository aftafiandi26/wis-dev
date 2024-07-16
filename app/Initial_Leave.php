<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Initial_Leave extends Model
{
	protected $table = 'initial_leave';

	protected $guarded = [];

	public function scopeJoinUsers($query)
	{
		return $query->join('users', 'users.id', '=', 'initial_leave.user_id');
	}

	public function scopeJoinDeptCategory($query)
	{
		return $query->join('dept_category', 'dept_category.id', '=', 'users.dept_category_id');
	}

	public function scopeJoinLeaveCategory($query)
	{
		return $query->join('leave_category', 'leave_category.id', '=', 'initial_leave.leave_category_id');
	}

	public function getUser($query)
	{
		return User::find($query);
	}

	public function user()
	{
		return User::find($this->user_id);
	}
}