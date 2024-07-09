<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkInventory extends Model
{
    protected $table = 'mark_inventory';


		public function scopeJoinUser($query)
	    {
	        return $query->leftjoin('users', 'users.id', '=', 'mark_inventory.id_userss');
	    }

	    public function scopeJoinSoftware($query)
	    {
	        return $query->leftjoin('assset_software', 'assset_software.id', '=', 'mark_inventory.id_software');
	    }

	    public function scopeJoinHardware($query)
	    {
	        return $query->leftjoin('asset_tracking', 'asset_tracking.id', '=', 'mark_inventory.id_hardware');
	    }

	    public function scopeJoinWsAvailability($query)
	    {
	        return $query->leftjoin('ws_Availability', 'ws_Availability.id', '=', 'mark_inventory.id_ws_availability');
	    }


}
