<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HR_Employes_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function index()
    {
        return view('HRDLevelAcces.employes.index');
    }

    public function datatables()
    {
        $query = User::where('active', 1)
            ->whereNotIn('users.username', ['admin', 'hr', 'wis_system'])
            ->whereNotIn('users.nik', ["", "123456789"])
            ->where('users.active', 1)
            ->where('users.id', 226)
            ->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->editColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->editColumn('address', function (User $user) {
                return $user->address . ', ' . $user->area . ', ' . $user->city;
            })
            ->editColumn('id_card', function (User $user) {
                return "'$user->id_card";
            })
            ->make(true);
    }
}