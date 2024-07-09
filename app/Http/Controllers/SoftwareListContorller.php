<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\AssetSoftware;

class SoftwareListContorller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if ($id === "60") {
            $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("+60 days")))->where('expiring_date', '>=', date('Y-m-d'))->orderBy('product', 'asc')->get();
        }elseif ($id === "30") {
            $getData = AssetSoftware::whereDate('expiring_date', '=', date('Y-m-d', strtotime("+30 days")))->where('expiring_date', '>=', date('Y-m-d'))->orderBy('product', 'asc')->get();
        }elseif ($id === "10") {
            $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("+10 days")))->where('expiring_date', '>=', date('Y-m-d'))->orderBy('product', 'asc')->get();
        }elseif ($id === "5") {
            $getData = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("+5 days")))->where('expiring_date', '>=', date('Y-m-d'))->orderBy('product', 'asc')->get();
        }
      
        /*$getData1 = AssetSoftware::whereDate('expiring_date', '<=', date('Y-m-d', strtotime("-1 days")))->where('expiring_date', '!=', '0000-00-00')->orderBy('product', 'asc')->get();*/
        $getData1 = AssetSoftware::whereBetween('expiring_date', [date('Y-m-d', strtotime('-90 days')), date('Y-m-d', strtotime("now"))])->where('expiring_date', '!=', '0000-00-00')->orderBy('product', 'asc')->get();
        
        return view::make('outside.SoftwareMailList.index', [
            'getData' => $getData,          
            'getData1' => $getData1, 
            'id' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
