<?php

namespace App\Http\Controllers;

use App\Dept_Category;
use App\Project_Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Storage;
use Validator;

class AllEmployesProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexProfile()
    {
        $dept = Dept_Category::find(auth()->user()->dept_category_id);

        $joinDate = auth()->user()->join_date;

        if ($joinDate == "0000-00-00" or $joinDate == null) {
            $joinDate = "--";
        }

        $endDate = auth()->user()->end_date;

        if ($endDate == "0000-00-00" or $endDate == null) {
            $endDate = "--";
        }

        $projects = Project_Category::orderBy('project_name', 'asc')->get();

        $mainProject = $projects->find(auth()->user()->project_category_id_1);

        if (empty($mainProject)) {
            $mainProject = "--";
        } else {
            $mainProject = $mainProject->project_name;
        }



        $secondProject = $projects->find(auth()->user()->project_category_id_2);

        if (empty($secondProject)) {
            $secondProject = "--";
        } else {
            $secondProject = $secondProject->project_name;
        }

        $thirdProject = $projects->find(auth()->user()->project_category_id_3);

        if (empty($thirdProject)) {
            $thirdProject = "--";
        } else {
            $thirdProject = $thirdProject->project_name;
        }

        $fourProject = $projects->find(auth()->user()->project_category_id_4);

        if (empty($fourProject)) {
            $fourProject = "--";
        } else {
            $fourProject = $fourProject->project_name;
        }

        $yourProjects = [
            "mainProject" => $mainProject,
            "secondProject" => $secondProject,
            "thirdProject" => $thirdProject,
            "fourProject" => $fourProject,
        ];

        $dorm_stat = [
            'Sharing' => 'Sharing',
            'Single Paid' => 'Single Paid'
        ];

        return view('all_employee.Profile.index', compact(['dept', 'joinDate', 'endDate', 'projects', 'yourProjects', 'dorm_stat']));
    }

    public function uploadImageProfile(Request $request, $id)
    {
        $users = User::find($id);
        $prof_pict = $users->prof_pict;

        $messages = [
            'imgUpload.image' => 'Please check your format image',
            'imgUpload.max'   => 'The maximum size of the image is only 2mb',
            'imgUpload.required' => 'We need you insert your image'
        ];

        $validator = Validator::make($request->all(), [
            'imgUpload' => 'required|image:jpeg,jpg,png|max:2048'
        ], $messages);

        if ($validator->fails()) {
            return redirect()->route('employes/profile/index')
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('imgUpload') && $request->file('imgUpload')->isValid()) {
            $file      =  $request->file('imgUpload');
            $prof_pict = time() . '_' . $file->getClientOriginalName();
            if ($users->prof_pict != 'no_avatar.jpg') {
                Storage::delete('prof_pict/' . $users->prof_pict);
            }
            $file->storeAs('prof_pict', $prof_pict);
        }

        $data = [
            'prof_pict'             => $prof_pict,
        ];

        User::where('id', auth()->user()->id)->update($data);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Your picture has been changed']));
        return redirect()->route('employes/profile/index');
    }

    public function modalProject($id, $project)
    {
        $allprojects = Project_Category::orderBy('project_name', 'asc')->get();

        return view('all_employee.Profile.modalProjects', compact(['allprojects', 'project', 'id']));
    }

    public function updateProject(Request $request, $id)
    {
        if ($id == 1) {
            User::where('id', auth()->user()->id)->update(['project_category_id_1' => $request->input('project')]);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Project 1 has been updated']));
        }

        if ($id == 2) {
            User::where('id', auth()->user()->id)->update(['project_category_id_2' => $request->input('project')]);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Project 2 has been updated']));
        }

        if ($id == 3) {
            User::where('id', auth()->user()->id)->update(['project_category_id_3' => $request->input('project')]);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Project 2 has been updated']));
        }

        if ($id == 4) {
            User::where('id', auth()->user()->id)->update(['project_category_id_4' => $request->input('project')]);
            Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Project 2 has been updated']));
        }

        return redirect()->route('employes/profile/index');
    }

    public function postPhone(Request $request)
    {
        $rule = [
            'phoneNumber' => 'required|numeric|min:10'
        ];

        $messages = [
            'phoneNumber.required' => 'Phone field is required',
            'phoneNumber.numeric'  => 'Input phone field just numeric',
            'phoneNumber.min'      => 'Phone field minimum length of 10 numbers',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->route('employes/profile/index')
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', auth()->user()->id)->update(['phone' => $request->input('phoneNumber')]);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Phone has been updated']));
        return redirect()->route('employes/profile/index');
    }

    public function postDormStat(Request $request)
    {
        User::where('id', auth()->user()->id)->update(['rusun_stat' => $request->input('dormStatus')]);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Dorm Status has been updated']));
        return redirect()->route('employes/profile/index');
    }

    public function postDormRoom(Request $request)
    {
        User::where('id', auth()->user()->id)->update(['rusun' => strtoupper($request->input('dormRoom'))]);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Dorm Room has been updated']));
        return redirect()->route('employes/profile/index');
    }

    public function postEducationInstituion(Request $request)
    {
        $req = title_case($request->input('education_institution'));

        User::where('id', auth()->user()->id)->update(['education_institution' => $req]);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Education Institute has been updated']));
        return redirect()->route('employes/profile/index');
    }

    public function postNickName(Request $request)
    {
        $rule = [
            'nickname'  => 'required|string'
        ];

        $messages = [
            'nickname.required'  => 'Nickname field is required',
            'nickname.string'    => 'Nickname field is just a letter'
        ];

        $req = title_case($request->input('nickname'));

        $validator = Validator::make($request->all(), $rule, $messages);

        if ($validator->fails()) {
            return redirect()->route('employes/profile/index')
                ->withErrors($validator)
                ->withInput();
        }

        User::where('id', auth()->user()->id)->update(['nickname' => $req]);
        Session::flash('message', Lang::get('messages.data_custom', ['data' => 'Nickname has been updated']));
        return redirect()->route('employes/profile/index');
    }
}