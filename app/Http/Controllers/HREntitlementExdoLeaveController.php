<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Initial_Leave;
use Datatables;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class HREntitlementExdoLeaveController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index($id)
    {
        $reverse = $id - 1;

        return view('HRDLevelAcces.leave.entitlement_exdo.index', compact(['id', 'reverse']));
    }

    public function dataIndex($id)
    {
        $query = Initial_Leave::whereYear('expired', $id)->orderBy('expired', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('nik', function (Initial_Leave $initial_Leave) {
                $return = $initial_Leave->user()->nik;

                return $return;
            })
            ->addColumn('fullname', function (Initial_Leave $initial_Leave) {
                $return = $initial_Leave->user()->getFullName();

                return $return;
            })
            ->addColumn('department', function (Initial_Leave $initial_Leave) {
                $return = $initial_Leave->user()->getDepartment();

                return $return;
            })
            ->addColumn('position', function (Initial_Leave $initial_Leave) {
                $return = $initial_Leave->user()->position;

                return $return;
            })
            ->add_column('actions', function (Initial_Leave $initial_Leave) {
                $id = $initial_Leave->id;

                return view('HRDLevelAcces.leave.entitlement_exdo.action', compact(['id']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function edit($id)
    {
        $query = Initial_Leave::find($id);

        return view('HRDLevelAcces.leave.entitlement_exdo.edit', compact(['query']));
    }

    public function update(Request $request, $id)
    {
        $rule = [
            'expired' => 'required|date',
            'initial' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rule);

        $data = [
            'expired' => $request->input('expired'),
            'initial' => $request->input('initial')
        ];

        if ($validator->fails()) {
            return redirect()->route('hr/entitlement/exdo/index', $request->input('year'))->with('getError', "sorry, please check your form inputted");
        } else {
            Session::flash('message', Lang::get('messages.data_updated', ['data' => 'Exdo Leave ' . $request->input('employee')]));
            Initial_Leave::where('id', $id)->update($data);
            return redirect()->route('hr/entitlement/exdo/index', $request->input('year'));
        }
    }
}