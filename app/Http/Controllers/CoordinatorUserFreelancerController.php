<?php

namespace App\Http\Controllers;

use App\Mail\Production\Request_User_FreelanceMail;
use App\Project_Category;
use App\User;
use App\User_Freelance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Facades\Datatables;

class CoordinatorUserFreelancerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function create()
    {
        $projects = Project_Category::orderBy('project_name', 'asc')->get();

        return view('production.freelance.create', compact(['projects']));
    }

    public function store(Request $request)
    {
        $rules = [
            'firstName' => "required|string",
            'lastName' => "required|string",
            'joinDate' => "required|date",
            'endDate' => "required|date",
            'position' => "required",
            'project' => "required|array",
            // 'project.*' => "in:option1,option2,option3",
            'email' => "required",
        ];

        // $cleanedInput = preg_replace('/[^A-Za-z0-9.]/', '', $request->input('username'));

        $data = [
            'first_name'    => $request->input('firstName'),
            'last_name'     => $request->input('lastName'),
            'joinDate'      => $request->input('joinDate'),
            'endDate'       => $request->input('endDate'),
            'position'      => title_case($request->input('position')),
            'project'       => json_encode($request->input('project')),
            'email'         => $request->input('email'),
            'create_by'     => auth()->user()->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('freelance/create')
                ->withErrors($validator)
                ->withInput();
        }

        User_Freelance::create($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Form has been successfully recorded']));
        return redirect()->route('freelance/view');
    }

    public function view()
    {
        $data = User_Freelance::find(5);

        $das = json_decode($data->project);
        $arrray = [];

        foreach ($das as $key => $value) {
            $project = Project_Category::find($value);
            $array[] = [
                'key' => $key,
                'value' => $value,
                'project' => $project->project_name
            ];
        };

        return view('production.freelance.index');
    }

    public function datatablesView()
    {
        $query = User_Freelance::latest();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User_Freelance $freelance) {
                return title_case($freelance->fullname());
            })
            ->addColumn('actions', 'production.freelance.actions')
            ->addColumn('requested', 'production.freelance.actionsRequested')
            ->rawColumns(['actions', 'requested'])
            ->make(true);
    }

    public function edit($id)
    {
        $projects = Project_Category::orderBy('project_name', 'asc')->get();

        $data = User_Freelance::find($id);
        $selectedProjects = json_decode($data->project);

        return view('production.freelance.edit', compact(['projects', 'data', 'selectedProjects']));
    }

    public function update(Request $request, $id)
    {
        $freelance = User_Freelance::find($id);
        $rules = [
            'firstName' => "required|string",
            'lastName' => "required|string",
            'joinDate' => "required|date",
            'endDate' => "required|date",
            'position' => "required",
            'project' => "required|array",
            // 'project.*' => "in:option1,option2,option3",
            'email' => "required",
        ];

        // $cleanedInput = preg_replace('/[^A-Za-z0-9.]/', '', $request->input('username'));

        $data = [
            'first_name'    => $request->input('firstName'),
            'last_name'     => $request->input('lastName'),
            'joinDate'      => $request->input('joinDate'),
            'endDate'       => $request->input('endDate'),
            'position'      => title_case($request->input('position')),
            'project'       => json_encode($request->input('project')),
            'email'         => $request->input('email'),
            'create_by'     => auth()->user()->id,
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('freelance/edit', $data->id)
                ->withErrors($validator)
                ->withInput();
        }

        $freelance->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Data has been successfully recorded']));
        return redirect()->route('freelance/view');
    }

    public function modalDestroy($id)
    {
        $freelancer = User_Freelance::find($id);
        $create_by = User::find($freelancer->create_by);
        $create_by = $create_by->getFullName();

        $user = null;
        if (!empty($freelancer->username)) {
            $user = "hallo";
        }

        $das = json_decode($freelancer->project);
        $projects = [];

        foreach ($das as $key => $value) {
            $projected = Project_Category::find($value);
            $projects[] = [
                'project' => $projected->project_name
            ];
        };

        return view('production.freelance.modalDestroy', compact(['freelancer', 'user', 'projects', 'create_by']));
    }

    public function destroy($id)
    {
        $freelancer = User_Freelance::find($id);

        Session::flash('message', Lang::get('messages.data_custom', ['data' => $freelancer->fullname() . ' removed']));
        $freelancer->delete();
        return redirect()->route('freelance/view');
    }

    public function modalEmail($id)
    {
        $data = User_Freelance::find($id);

        return view('production.freelance.modalEmail', compact(['data']));
    }

    public function sendMail(Request $request, $id)
    {
        $rules = [
            'subject' => ["required", "string", "min:3"],
            'summary' => ["required", 'string', "min:3"]
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, Request username cannot be processed.']));
            return redirect()->route('freelance/view');
        }

        $data = [
            'subject' => $request->input('subject'),
            'message' => $request->input('summary'),
            'id'      => $id
        ];

        Mail::send(new Request_User_FreelanceMail($data));

        Session::flash('success', Lang::get('messages.data_custom', ['data' => 'Sent, Username will be processed']));
        return redirect()->route('freelance/view');
    }
}