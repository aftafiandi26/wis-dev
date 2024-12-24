<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;

class HRD_ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active', 'hr']);
    }

    public function storerProject1(Request $request, $id)
    {
        $user = User::find($id);

        $data = [
            'project_category_id_1' => $request->input('project1')
        ];

        User::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $user->getFullName() . ' Project 1 terupdated.']));
        return redirect()->route('projectHRD');
    }

    public function storerProject2(Request $request, $id)
    {
        $user = User::find($id);

        $data = [
            'project_category_id_2' => $request->input('project2')
        ];

        User::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $user->getFullName() . ' Project 2 terupdated.']));
        return redirect()->route('projectHRD');
    }

    public function storerProject3(Request $request, $id)
    {
        $user = User::find($id);

        $data = [
            'project_category_id_3' => $request->input('project3')
        ];

        User::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $user->getFullName() . ' Project 3 terupdated.']));
        return redirect()->route('projectHRD');
    }

    public function storerProject4(Request $request, $id)
    {
        $user = User::find($id);

        $data = [
            'project_category_id_4' => $request->input('project4')
        ];

        User::where('id', $id)->update($data);

        Session::flash('message', Lang::get('messages.data_custom', ['data' =>  $user->getFullName() . ' Project 4 terupdated.']));
        return redirect()->route('projectHRD');
    }
}