<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Attendance_Questions;
use App\Project_Category;
use App\ProjectGroup;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class GM_Summary_AttendancesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        $employes = User::where('active', true)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();
        return view('GenaralManager.summary.attendance.index', compact(['employes']));
    }

    public function dataTablesIndex()
    {
        // $projects = Project_Category::where('actived', true)->whereNotIn('id', [42, 83, 85])->orderBy('project_name', 'asc')->get();
        $projects = ProjectGroup::where('active', true)->whereNotIn('id', [12, 13])->orderBy('group_name', 'asc')->get();

        $date = Carbon::now()->toDateString();

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('dated', function (ProjectGroup $project) use ($date) {
                return $date;
            })
            ->addColumn('employes', function (ProjectGroup $project) use ($date) {
                $attendance = Attendance::with(['relationsQuest'])
                    ->whereDate('start', $date)
                    ->whereHas('relationsQuest', function ($query) use ($project) {
                        $query->where('group', $project->id); // Filter berdasarkan kolom project
                    })
                    ->where('in', true)
                    ->get();

                return $attendance->count();
            })
            ->addColumn('actions', function (ProjectGroup $project) use ($date) {
                $id = $project->id;

                return view('GenaralManager.summary.attendance.actions', compact(['id', 'date']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function dataTatablesShowEmployes($id, $date)
    {
        $attendance = Attendance::with(['relationsQuest'])
            ->whereDATE('start', $date)
            ->whereHas('relationsQuest', function ($query) use ($id) {
                $query->where('group', $id); // Filter berdasarkan kolom project
            })
            ->get();

        // $attendance = Attendance::whereDATE('start', $date)->get();

        return Datatables::of($attendance)
            ->addIndexColumn()
            ->addColumn('project', function (Attendance $attendance) {
                // Ambil kolom project dari relasi relationsQuest
                $project = ProjectGroup::find($attendance->relationsQuest->group);

                return $project->group_name; // Tampilkan '-' jika null
            })
            ->addColumn('employee', function (Attendance $attendance) {
                $user = User::find($attendance->user_id);

                return $user->getFullName();
            })
            ->addColumn('dated', function (Attendance $attendance) {
                $date = date('Y-m-d', strtotime($attendance->start));

                return $date;
            })
            ->addColumn('position', function (Attendance $attendance) {
                $user = User::find($attendance->user_id);

                return $user->position;
            })
            ->make(true);
    }

    public function filterDate(Request $request)
    {

        $start = $request->input('start');
        $end = $request->input('end');

        if ($start > $end) {
            Session::flash('getError', Lang::get('messages.data_custom', ['data' => 'Sorry, please check your date']));
            return redirect()->route('gm/summary/attendance/index');
        }

        $employes = User::where('active', true)->where('dept_category_id', 6)->where('nik', '!=', 123456789)->orderBy('first_name', 'asc')->get();

        $awal = new DateTime($start);
        $akhir = new DateTime($end);

        $jsonDate = [];

        // Loop untuk menghasilkan tanggal-tanggal
        while ($awal <= $akhir) {
            $jsonDate[] =  $awal->format('Y-m-d');
            $awal->modify('+1 day'); // Tambahkan 1 hari
        }

        $projects = Project_Category::where('actived', true)->whereNotIn('id', [42, 83, 85])->orderBy('project_name', 'asc')->get();
        $projects = ProjectGroup::where('active', true)->whereNotIn('id', [12, 13])->orderBy('group_name', 'asc')->get();
        // $attendance = Attendance::with(['relationsQuest'])->whereDATE('start', '>=', $start)->whereDATE('start', '<=', $end)->where('in', true)->get();
        $jsonProjects = [];

        foreach ($projects as $project) {
            $tanggal = [];

            foreach ($jsonDate as $dated) {
                $countAbsen = [];
                $absensi = Attendance::with(['relationsQuest'])->whereDATE('start', $dated)->where('in', true)->get();
                foreach ($absensi as $key => $abs) {
                    if ($abs->relationsQuest && $abs->relationsQuest->group == $project->id) {
                        $countAbsen[] = [
                            'id'           => $abs->id,
                            'user_id'       => $abs->user_id,
                            'project_id'    => $abs->relationsQuest->group,
                            'project_name'  => $abs->relationsQuest->projectGroup(),
                            'date'          => date('Y-m-d', strtotime($abs->start))
                        ];
                    }
                }


                $tanggal[] = [
                    'date'          => $dated,
                    'project_id'    =>  $project->id,
                    'countAbsen'    => count($countAbsen),
                ];
            }

            $jsonProjects[] = [
                'id'    => $project->id,
                'name'  => $project->group_name,
                'tanggal' => $tanggal
            ];
        }

        // dd($jsonProjects);

        return view('GenaralManager.summary.attendance.filterDate', compact(['projects', 'jsonDate', 'jsonProjects', 'employes']));
    }

    public function filterDataTalesDate($start, $end)
    {
        $projects = ProjectGroup::where('active', true)->whereNotIn('id', [12, 13])->orderBy('group_name', 'asc')->get();

        return Datatables::of($projects)
            ->addIndexColumn()
            ->addColumn('dated', function (ProjectGroup $project) use ($start, $end) {
                return $start . ' - ' . $end;
            })
            ->addColumn('employes', function (ProjectGroup $project) use ($start, $end) {

                $attendance = Attendance::with(['relationsQuest'])
                    ->whereDate('start', '>=', $start)
                    ->whereDate('start', '<=', $end)
                    ->whereHas('relationsQuest', function ($query) use ($project) {
                        $query->where('group', $project->id); // Filter berdasarkan kolom project
                    })
                    ->get();

                return $attendance->count();
            })
            ->addColumn('actions', function (ProjectGroup $project) use ($start, $end) {
                $id = $project->id;

                $started = $start;
                $ended = $end;

                return view('GenaralManager.summary.attendance.filterDateActions', compact(['id', 'started', 'ended']));
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function filterDataTablesShowEmployee($id, $start, $end)
    {
        $attendance = Attendance::with(['relationsQuest'])
            ->whereDATE('start', '>=', $start)
            ->whereDATE('start', '<=', $end)
            ->whereHas('relationsQuest', function ($query) use ($id) {
                $query->where('group', $id); // Filter berdasarkan kolom project
            })
            ->get();

        return Datatables::of($attendance)
            ->addIndexColumn()
            ->addColumn('project', function (Attendance $attendance) {
                // Ambil kolom project dari relasi relationsQuest
                $project = ProjectGroup::find($attendance->relationsQuest->group);

                return $project->group_name; // Tampilkan '-' jika null
            })
            ->addColumn('employee', function (Attendance $attendance) {
                $user = User::find($attendance->user_id);

                return $user->getFullName();
            })
            ->addColumn('dated', function (Attendance $attendance) {
                $date = date('Y-m-d', strtotime($attendance->start));

                return $date;
            })
            ->addColumn('position', function (Attendance $attendance) {
                $user = User::find($attendance->user_id);

                return $user->position;
            })
            ->make(true);
    }

    public function employeeFilter(Request $request)
    {
        $employes = User::where('active', true)->where('dept_category_id', 6)->orderBy('first_name', 'asc')->get();

        return view('GenaralManager.summary.attendance.filterEmployes', compact(['employes']));
    }

    public function employeeFilterShow($id, $start, $end)
    {
        $attendance = Attendance::with(['relationsQuest'])
            ->whereDATE('start', '>=', $start)
            ->whereDATE('start', '<=', $end)
            ->where('user_id', $id)
            ->get();

        return Datatables::of($attendance)
            ->addIndexColumn()
            ->addColumn('position', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->position;
            })
            ->addColumn('fullname', function (Attendance $att) {
                $return = User::find($att->user_id);
                return $return->getFullName();
            })
            ->addColumn('dated', function (Attendance $att) {
                $return = date('Y-m-d', strtotime($att->start));

                return $return;
            })
            ->addColumn('group_name', function (Attendance $att) {
                if ($att->relationsQuest->group) {
                    $return = ProjectGroup::find($att->relationsQuest->group);
                    return $return->group_name;
                }

                return null;
            })
            ->make(true);
    }
}