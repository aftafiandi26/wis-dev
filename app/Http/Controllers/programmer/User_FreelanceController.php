<?php

namespace App\Http\Controllers\programmer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project_Category;
use App\User;
use App\User_Freelance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class User_FreelanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('dev.production.freelance.user.index');
    }

    public function datatables()
    {
        $query = User_Freelance::latest();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User_Freelance $freelance) {
                return $freelance->fullname();
            })
            ->editColumn('create_by', function (User_Freelance $freelance) {
                $user = User::find($freelance->create_by);

                return $user->getFullName();
            })
            ->addColumn('actions', 'dev.production.freelance.user.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function modalUsername($id)
    {
        $data = User_Freelance::find($id);
        $user = User::find($data->create_by);

        $nik = null;

        if ($data->user_id) {
            $nik = User::find($data->user_id);
            $nik = $nik->nik;
        }

        $array = [];

        $decode = json_decode($data->project);

        foreach ($decode as $key => $value) {
            $project = Project_Category::find($value);
            $array[] = $project->project_name;
        }

        return view('dev.production.freelance.user.modalUsername', compact(['data', 'user', 'array', 'nik']));
    }

    public function storeUsername(Request $request, $id)
    {
        $rules = [
            'username'  => ["required", 'unique:users,username'],
            'nik'       => ["required", "unique:users,nik"],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // dd($validator->messages());
            // Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, username has already']));
            // return redirect()->route('dev/user/freelance/index');
            return redirect()->route('dev/user/freelance/index')
                ->withErrors($validator)
                ->withInput();
        }

        $freelancer = User_Freelance::find($id);

        if ($freelancer->user_id) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, account is already']));
            return redirect()->route('dev/user/freelance/index');
        }

        $data = [
            'username'              => $request->input('username'),
            'nik'                   => $request->input('nik'),
            'password'              => Hash::make($request->input('password')),
            'first_name'            => $freelancer->first_name,
            'last_name'             => $freelancer->last_name,
            'dept_category_id'      => 10,
            'position'              => $freelancer->position,
            'emp_status'            => 'Freelance',
            'nationality'           => null,
            'join_date'             => $freelancer->joinDate,
            'end_date'              => $freelancer->endDate,
            'email'                 => $freelancer->email,
            'created_by'            => auth()->user()->first_name . ' ' . auth()->user()->last_name,
            'active'                => true,
            'admin'                 => false,
            'initial_annual'        => false,
            'hr'                    => false,
            'hd'                    => false,
            'hrd'                   => false,
            'gm'                    => false,
            'user'                  => false,
            'sp'                    => true,
            'spHRD'                 => false,
            'ticket'                => false,
            'block_stat'            => false,
            'lineGM'                => false,
            'prof_pict'              => 'no_avatar.jpg',
        ];

        User::insert($data);
        $user = User::where('nik', $data['nik'])->first();

        $freelancer->update([
            'user_id' => $user['id'],
            'username' => $data['username'],
        ]);

        Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Username accepted']));
        return redirect()->route('dev/user/freelance/index');
    }
}