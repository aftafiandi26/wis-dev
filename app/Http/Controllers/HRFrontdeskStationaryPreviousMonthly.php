<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRFrontdeskStationaryPreviousMonthly extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index($date)
    {
        $nowMonth = date('m');

        $countMonth = $date - $nowMonth;

        $nameCountMonth = $date - $nowMonth;

        // $previ = --$countMonth;

        return view('HRDLevelAcces.frontedesk.previousMonthly.index', compact(['date', 'countMonth', 'nameCountMonth']));
    }
}
