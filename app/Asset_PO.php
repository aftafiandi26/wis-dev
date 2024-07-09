<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset_PO extends Model
{
     protected $table = 'asset_po_invoice';


		public function scopeJoinDeptCategory($query)
	    {
	        return $query->leftjoin('dept_category', 'dept_category.id', '=', 'asset_po_invoice.po_department');
	    }

	    public function scopeJoinAsset_Tracking($query)
	    {
	    	return $query->leftjoin('asset_tracking', 'asset_tracking.id_asset_po', '=', 'asset_po_invoice.id');
	    }

	    public function scopeJoinFinanceTracking($query)
	    {
	    	return $query->leftjoin('finance_tracking', 'finance_tracking.id_asset_po', '=', 'asset_po_invoice.id');
	    }

}
