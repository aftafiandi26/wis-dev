<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

	class Ws_Map extends Model
	{
		protected $table = 'ws_map';


		public function scopeJoinWs_Availability($query)
	    {
	        return $query->leftjoin('ws_Availability', 'ws_Availability.hostname', '=', 'ws_map.workstation');
	    }

	    public function scopeJoinAsseting_IT1($query)
	    {
	    	return $query->leftjoin('asseting_barcode', 'asseting_barcode.id', '=', 'ws_map.id_monitor1');
	    }

	    public function scopeJoinAsseting_IT2($query)
	    {
	    	return $query->leftjoin('asseting_barcode', 'asseting_barcode.id', '=', 'ws_map.id_monitor2');
	    }
	}