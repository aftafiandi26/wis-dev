<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absences extends Model
{
    protected $table = 'absences';

    public function scopeJoinUsers($query)
		{
			return $query->leftjoin('users', 'users.id', '=', 'absences.id_user');
		}		
	
	public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function getUser()
    {
        return User::find($this->id_user);
    }
}
