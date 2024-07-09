<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dormitories;
use App\Dormitory;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Datatables;

class HRDormitoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        $tb03 = Dormitories::where('room_block', 3)->get();
        $tb04 = Dormitories::where('room_block', 4)->get();
        $tb05 = Dormitories::where('room_block', 5)->get();
        $tb06 = Dormitories::where('room_block', 6)->get();
        $tb010 = Dormitories::where('room_block', 10)->get();

        $emp = User::where('active', 1)->whereNotIn('nik', ["", '123456789'])->orderBY('first_name', 'asc')->get();

        return view('HRDLevelAcces.rusun.dormitory.index', compact(['tb03', 'tb04', 'tb05', 'tb06', 'tb010', 'emp']));
    }

    public function dataindex()
    {
        $query = Dormitories::orderBY('room_number', 'asc')->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('room_block', function (Dormitories $dormitories) {
                $tb = "TB0";
                if ($dormitories->room_block >= 10) {
                    $tb = "TB";
                }
                return $tb . $dormitories->room_block;
            })
            ->addColumn('nik', function (Dormitories $dormitories) {
                $return = $dormitories->getUser();
                return $return->nik;
            })
            ->addColumn('fullname', function (Dormitories $dormitories) {
                $return = $dormitories->getUser()->getFullName();
                return $return;
            })
            ->addColumn('position', function (Dormitories $dormitories) {
                $return = $dormitories->getUser();
                return $return->position;
            })
            ->addColumn('department', function (Dormitories $dormitories) {
                $return = $dormitories->getUser()->getDepartment();
                return $return;
            })
            ->addColumn('actions', function (Dormitories $dormitories) {
                return view('HRDLevelAcces.rusun.dormitory.actions', compact(['dormitories']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalEdit($id)
    {
        $data = Dormitories::find($id);

        return view('HRDLevelAcces.rusun.dormitory.modalEdit', compact(['data']));
    }

    public function updateDorm(Request $request, $id)
    {
        $data = [
            'room_block' => $request->input('block'),
            'room_number' => $request->input('room'),
            'room_stat' => $request->input('status')
        ];

        Dormitories::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.dorm_update', ['data' => 'Dormitory']));
        return redirect()->route('hr/management/dorm/index');
    }

    public function addDormitories(Request $request)
    {
        $data = [
            'user_id' => $request->input('employee'),
            'room_block' => $request->input('block'),
            'room_number' => $request->input('room'),
            'room_stat' => $request->input('status'),
            'status'    => 1
        ];

        $findUser = Dormitories::where('user_id', $request->input('employee'))->first();
        $user = User::find($request->input('employee'));

        if (!empty($findUser)) {
            Session::flash('getError', Lang::get('messages.dorm_fail', ['name' => $user->getFullName()]));
            return redirect()->route('hr/management/dorm/index');
        }

        Dormitories::create($data);

        Session::flash('success', Lang::get('messages.dorm_create', ['data' => 'Dormitory']));
        return redirect()->route('hr/management/dorm/index');
    }

    public function modalDeleteDormitories($id)
    {
        $data = Dormitories::find($id);

        return view('HRDLevelAcces.rusun.dormitory.modalDelete', compact(['data']));
    }

    public function deleteDormitories($id)
    {
        $dorm = Dormitories::find($id);

        Session::flash('getError', Lang::get('messages.dorm_delete', ['name' => $dorm->getUser()->getFullName()]));
        $dorm->delete();
        return redirect()->route('hr/management/dorm/index');
    }
}