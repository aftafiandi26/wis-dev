<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class AllEmployesForProductionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function indexPhoneBookProduction()
    {
        return view('production.Employes.index');
    }

    public function objetDataPhoneBookProduction()
    {
        $data = User::where('active', 1)->whereNotIn('nik', ["", 123456789])->orderBy('first_name', 'asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('department', function (User $user) {
                return $user->getDepartment();
            })
            ->addColumn('project', function (User $user) {
                $project1 = $user->getProjectName($user->project_category_id_1);
                $project2 = $user->getProjectName($user->project_category_id_2);
                $project3 = $user->getProjectName($user->project_category_id_3);
                $project4 = $user->getProjectName($user->project_category_id_4);

                if ($project2 != null) {
                    $project2 = " - $project2";
                }

                if ($project3 != null) {
                    $project3 = " - $project3";
                }

                if ($project4 != null) {
                    $project4 = " - $project4";
                }

                return $project1 . $project2 . $project3 . $project4;
            })
            ->make(true);
    }
}