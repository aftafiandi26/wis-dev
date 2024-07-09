<?php

namespace App\Http\Controllers;

use App\stationary_stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FrontdeskMineralHistoricalController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function headline()
    {
        return "(hr) Mineral Water";
    }

    private function key_param()
    {
        return 2;
    }

    private function receptionist()
    {
        return "Dhea Karina Putri";
    }

    private function  getMonth($month)
    {
        switch ($month) {
            case  1:
                return  "January";
                break;
            case  2:
                return  "February";
                break;
            case  3:
                return  "March";
                break;
            case  4:
                return  "April";
                break;
            case  5:
                return  "May";
                break;
            case  6:
                return  "June";
                break;
            case  7:
                return  "July";
                break;
            case  8:
                return  "August";
                break;
            case  9:
                return  "September";
                break;
            case  10:
                return  "October";
                break;
            case  11:
                return  "November";
                break;
            case  12:
                return  "December";
                break;
        }
    }


    public function index($year, $month)
    {

        $headline = $this->headline();

        $key_param = $this->key_param();

        $getMonth = $this->getMonth($month);
        $getBeforeMonth = $this->getMonth($month - 1);

        $waters = stationary_stock::where('category_item', 2)->orderBy('kode_barang', 'asc')->get();

        return view('HRDLevelAcces.frontedesk.stationary.mineral.historical.index', compact(['waters', 'headline', 'key_param', 'year', 'month', 'getMonth', 'getBeforeMonth']));
    }
}