<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetSoftware extends Model
{
   protected $table = 'assset_software';

		public function scopeJoinUsers($query)
	    {
	        return $query->leftjoin('users', 'users.id', '=', 'assset_software.id_users');
	    }

	    public function scopeJoinWs_Availability($query)
	    {
	        return $query->leftjoin('ws_Availability', 'ws_Availability.hostname', '=', 'assset_software.installed_in');
	    }
}
