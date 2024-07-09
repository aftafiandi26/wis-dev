<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_Tracking extends Model
{
   protected $table = 'asset_tracking';


		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'asset_tracking.dept_id');
	    }

	    public function scopeJoinFinanceTracking($query)
	    {
	    	return $query->leftjoin('finance_tracking', 'finance_tracking.view_asset_po', '=', 'asset_tracking.view_asset_po');
	    }
}
