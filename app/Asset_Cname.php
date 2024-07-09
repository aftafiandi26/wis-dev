<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_Cname extends Model
{
   protected $table = 'asset_cname';

		public function scopeJoinAsset_Tracking($query)
	    {
	        return $query->leftjoin('asset_tracking', 'asset_tracking.category_name_id', '=', 'asset_cname.key_mark');
	    }
}
