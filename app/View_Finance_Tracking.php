<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View_Finance_Tracking extends Model
{
    protected $table = "view_finace_tracking";

     public function scopeJoinFinanceTracking($query)
	    {
	    	return $query->leftjoin('finance_tracking', 'finance_tracking.view_po_number', '=', 'view_finace_tracking.v_view_po_number');
	    }
}
