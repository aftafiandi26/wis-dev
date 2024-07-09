<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HRExEmployesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hrd']);
    }

    public function index()
    {
        return view('HRDLevelAcces.ex-employes.index');
    }

    public function objetDataIndex()
    {
        $data = User::select([
            'id', 'nik', 'first_name', 'last_name', 'dept_category_id', 'position', 'emp_status', 'nationality', 'join_date', 'end_date', 'dob', 'pob', 'gender', 'maiden_name', 'province', 'id_card', 'religion', 'marital_status', 'education', 'education_institution'
        ])->where('active', 0)->orderBy('first_name', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('actions', 'HRDLevelAcces.ex-employes.action')
            ->editColumn('join_date', function (User $user) {
                return $user->converDate($user['join_date']);
            })
            ->editColumn('end_date', function (User $user) {
                return $user->converDate($user['end_date']);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalDataIndex($id)
    {
        $user = User::find($id);

        return view('HRDLevelAcces.ex-employes.modal', compact(['user']));
    }
}