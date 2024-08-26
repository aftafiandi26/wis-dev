<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Attendance_Questions;
use App\Project_Category;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class HR_QuestionerJOB_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        $users = User::where('active', 1)->get();
        $getProjects = Project_Category::whereIn('actived', [1, 2])->orderBy('project_name', 'asc')->get();
        $arrayProject = [];
        $proj = [];

        foreach ($getProjects as $a) {
            $arrayProject[] = $a->project_name;
        }

        foreach ($users as $user) {
            $questioner = Attendance_Questions::where('user_id', $user->id)->get();
            foreach ($questioner as $quest) {
                if (!empty($quest->projects)) {
                    $projectIds = json_decode($quest->projects, true);
                    $projects = Project_Category::whereIn('id', $projectIds)->get();
                    foreach ($projects as $project) {
                        $proj[] = $project->project_name;
                    }
                }
            }
        }

        $name_counts = array_count_values($proj);

        $counted = [];
        foreach ($name_counts as $name => $count) {
            $counted[] = ['name' => $name, 'count' => $count];
        }

        $result = [];

        foreach ($arrayProject as $sd) {
            $count = 0;
            foreach ($counted as $val) {
                if ($val['name'] === $sd) {
                    $count = $val['count'];
                    break; // Exit the inner loop once a match is found
                }
            }
            $result[] = $count;
        }

        $jsonProject = json_encode($arrayProject, true);
        $jsonResult = json_encode($result, true);

        return view('HRDLevelAcces.attendances.questioner.job', compact(['jsonProject', 'jsonResult']));
    }

    public function datatables()
    {
        $query = Attendance_Questions::where('projects', '!=', null)->get();

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (Attendance_Questions $e) {
                return $e->user()->getFullName();
            })
            ->addColumn('projectName', function (Attendance_Questions $e) {
                $json = json_decode($e->projects, true);
                $k = [];

                foreach ($json as $value) {
                    $p = Project_Category::find($value);

                    if ($p) {
                        // Add the project name to the array
                        $k[] = $p->project_name;
                    }
                }
                return $k;
            })
            ->addColumn('date', function (Attendance_Questions $e) {
                $attend = Attendance::where('quest_id', $e->id)->first();

                return $attend->start;
            })
            ->make(true);
    }
}