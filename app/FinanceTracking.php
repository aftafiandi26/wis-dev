<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinanceTracking extends Model
{
   protected $table = 'finance_tracking';

		public function scopeJoinAsset_Tracking($query)
	    {
	        return $query->leftjoin('asset_tracking', 'asset_tracking.view_po_number', '=', 'finance_tracking.view_po_number');
	    }

	    public function scopeJoinAsset_PO($query)
	    {
	        return $query->leftjoin('asset_po_invoice', 'asset_po_invoice.id', '=', 'finance_tracking.id_asset_po');
	    }
	    
}
