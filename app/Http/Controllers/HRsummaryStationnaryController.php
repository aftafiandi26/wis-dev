<?php

namespace App\Http\Controllers;

use App;
use App\Http\Controllers\Controller;
use App\stationary_stock;
use App\Stationary_transaction;
use App\stationary_count;
use App\stationary_kategori;
use App\StationeryHistory;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\PDF;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Storage;
use Yajra\Datatables\Facades\Datatables;
use Yajra\DataTables\Html\Builder;

class HRsummaryStationnaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.frontedesk.summaryStatinary.history');
    }

    public function dataIndex()
    {
        $modal = StationeryHistory::whereYear('updated_at', date('Y'))->get();

        return Datatables::of($modal)
                ->addIndexColumn()
                ->addColumn('item', function(StationeryHistory $query){
                    $data = stationary_stock::where('kode_barang', $query->kode_barang)->value('name_item');
                    return $data;
                })
                ->make(true);
    }
}
