<?php

namespace App\Http\Controllers;

use App\stationary_stock;
use App\Stationary_transaction;
use Google\Service\Spanner\Transaction;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class frontdeskMineralTrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function headline()
    {
        return "(hr) Mineral Water - Tracking";
    }

    private function key_param()
    {
        return 2;
    }

    private function receptionist()
    {
        return "Dhea Karina Putri";
    }

    private function price_format($id)
    {
        return  number_format($id, 0, ',', '.');
    }

    public function index($id)
    {
        $headline = $this->headline();

        $stocked = stationary_stock::find($id);

        return view('HRDLevelAcces.frontedesk.stationary.mineral.tracking.index', compact(['headline', 'stocked']));
    }

    public function objectIndex($id)
    {
        $data = Stationary_transaction::where('kode_barang', $id)->where('key_param', $this->key_param())->where('status_transaction', 2)->orderBy('date_out_stock', 'desc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('uom', function (Stationary_transaction $transaction) {
                $return = $transaction->getStock();
                return $return->satuan;
            })
            ->addColumn('position', function (Stationary_transaction $stationary_transaction) {
                $user = $stationary_transaction->getUser();
                $return = null;
                if ($user) {
                    $return = $user->position;
                }
                return $return;
            })
            ->addColumn('department', function (Stationary_transaction $stationary_transaction) {
                $user = $stationary_transaction->getUser();
                $return = null;
                if ($user) {
                    $return = $user->getDepartment();
                }
                return $return;
            })
            ->addColumn('totalPrice', function (Stationary_transaction $stationary_transaction) {
                $return = $stationary_transaction->out_stock * $stationary_transaction->price;

                return "IDR " . $this->price_format($return);
            })
            ->addColumn('price_format', function (Stationary_transaction $stationary_transaction) {
                return "IDR " . $stationary_transaction->price;
            })
            ->make(true);
    }
}