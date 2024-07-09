<?php

namespace App\Http\Controllers;

use App\stationary_kategori;
use App\stationary_stock;
use App\Stationary_transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class FrontdeskStationeryMonthController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    private function headline()
    {
        return "(hr) Stationery (atk - )";
    }

    private function key_param()
    {
        $return = new FrontdeskStationeryController();
        $return = $return->key_param();

        return $return;
    }

    private function receptionist()
    {
        $return = new FrontdeskStationeryController();
        $return = $return->receptionist();
        return $return;
    }

    public function index($month)
    {
        $headline = $this->headline();
        $key_param = $this->key_param();

        $waters = stationary_stock::where('category_item', $key_param)->orderBy('kode_barang', 'asc')->get();
        $categories = stationary_kategori::where('key_param', $key_param)->orderBy('unik_kategori', 'asc')->get();

        $previous = date('F', strtotime('previous month', strtotime($month)));
        $next = date('F', strtotime('next month', strtotime($month)));
        $lastDay = date('t', strtotime($month));

        return view('HRDLevelAcces.frontedesk.stationary.find.atk.index', compact(['waters', 'headline', 'key_param', 'categories', 'previous', 'next', 'month', 'lastDay']));
    }

    public function inStocked($id, $month)
    {
        $headline = $this->headline();

        $stocks = stationary_stock::where('id', $id)->first();

        return view('HRDLevelAcces.frontedesk.stationary.find.atk.intStock', compact(['stocks', 'headline', 'month']));
    }

    public function storeInStocked(Request $request, $id, $month)
    {
        $key_param = $this->key_param();

        $rules = [
            'date_stock' => 'required|date',
            'qty'        => 'required|numeric'
        ];

        $data = [
            'kode_barang' => $request->input('code_item'),
            'in_stock'  => $request->input('qty'),
            'date_in_stock' => $request->input('date_stock'),
            'status_transaction' => 1,
            'key_param' => $key_param,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/purchase/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {
            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data in stock successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/atk/month/index', [$month]);
        }
    }

    public function outStocked($id, $month)
    {
        $headline = $this->headline();
        $stocks = stationary_stock::where('id', $id)->first();
        $users = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();
        return view('HRDLevelAcces.frontedesk.stationary.find.atk.outStock', compact(['stocks', 'users', 'headline', 'month']));
    }

    public function storeOutStocked(Request $request, $id, $month)
    {
        $user = $request->input('user1');
        $key_param = $this->key_param();

        if ($request->input('user')) {
            $user = User::find($request->input('user'));
            $user = $user->getFullName();
        }

        $rules = [
            'date_stock' => 'required|date',
            'qty'    => 'required|numeric|min:0',
            'describe' => 'min:3',
        ];

        $data = [
            'kode_barang' => $request->input('code_item'),
            'out_stock'  => $request->input('qty'),
            'date_out_stock' => $request->input('date_stock'),
            'key_param'        => $key_param,
            'user_id'        => $request->input('user'),
            'employes'        => $user,
            'describe'        => $request->input('describe'),
            'status_transaction' => 2,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('stationery/atk/out/add', [$id])
                ->withErrors($validator)
                ->withInput();
        } else {

            $stocked = stationary_stock::where('kode_barang', $request->input('code_item'))->first();

            if (empty($stocked)) {
                Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry!, Data stock code:' . $request->input('code_item') . ' cannot be found.']));
                return Redirect::route('stationery/atk/out/add', $id);
            }

            Stationary_transaction::insert($data);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data out item successfully added. Code: ' . $request->input('code_item')]));
            return Redirect::route('stationery/atk/month/index', [$month]);
        }
    }
}