<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\ProjectGroup;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Facades\Datatables;

class GM_ProjectTimeSheetControlller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'active']);
    }

    public function index()
    {
        return view('GenaralManager.summary.perfomance.index');
    }

    public function dataFilter(Request $request)
    {
        // if ($request->input('month') == NULL) {
        //     Session::flash('getError', Lang::get('messages.data_custom', ['data' => "Sorry, data nothing!!"]));
        //     return redirect()->route('gm/employee-time-sheet/index');
        // }

        // $month = $request->input('month');
        // $year  = $request->input('year');
        $count = $request->input('counting');

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        if ($count == 1) {
            return redirect()->route('gm/employee-time-sheet/filter', compact(['startDate', 'endDate']));
        }

        if ($count == 2) {
            return redirect()->route('gm/employee-time-sheet/filterDay', compact(['startDate', 'endDate']));
        }
    }

    public function filter($startDate, $endDate)
    {
        $projectGroups = ProjectGroup::where('active', true)->orderBy('id', 'asc')->get();

        return view('GenaralManager.summary.perfomance.filterRange', compact('startDate', 'endDate', 'projectGroups'));
    }

    public function dataTablesFilter($startDate, $endDate)
    {
        $query = User::select('id', 'first_name', 'last_name', 'position', 'nik')->where('id', 303)->where('active', 1)->where('dept_category_id', 6)->whereNotIn('nik', ["123456789", ""])->orderBy('first_name', 'asc')->get();
        // set_time_limit(120);

        $attendances = Attendance::with(['relationsQuest'])
            ->where('start', [$startDate, $endDate])
            ->get();

        $attendances = Attendance::with(['relationsQuest'])
            ->whereDATE('start', '>=', $startDate)
            ->whereDATE('start', '<=', $endDate)
            ->get()
            ->groupBy('user_id');

        $groupCounts = $attendances->map(function ($items) {
            return $items->groupBy('relationsQuest.group')->map->count();
        });
        dd($attendances);


        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('total', function (User $user) use ($startDate, $endDate) {
                $user->total = Attendance::with(['relationsQuest'])->where('user_id', $user->id)->whereDATE('start', '>=', $startDate)->whereDATE('start', '<=', $endDate)->whereHas('relationsQuest', function ($query) {
                    $query->where('group', '!=', null);
                })->count();

                return $user->total;
            })
            ->addColumn('column1', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][1]) ? $groupCounts[$user->id][1] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column2', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][2]) ? $groupCounts[$user->id][2] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column3', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][3]) ? $groupCounts[$user->id][3] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column4', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][4]) ? $groupCounts[$user->id][4] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column5', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][5]) ? $groupCounts[$user->id][5] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column6', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][6]) ? $groupCounts[$user->id][6] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column7', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][7]) ? $groupCounts[$user->id][7] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column8', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][8]) ? $groupCounts[$user->id][8] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column9', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][9]) ? $groupCounts[$user->id][9] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column10', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][10]) ? $groupCounts[$user->id][10] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column11', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][11]) ? $groupCounts[$user->id][11] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column12', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][12]) ? $groupCounts[$user->id][12] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column13', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][13]) ? $groupCounts[$user->id][13] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column14', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][14]) ? $groupCounts[$user->id][14] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->addColumn('column15', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0%";
                }
                $group1Count = isset($groupCounts[$user->id][15]) ? $groupCounts[$user->id][15] : 0;
                return $total > 0 ? round(($group1Count / $total) * 100, 1) . '%' : '0%';
            })
            ->make(true);
    }

    public function filterDay($startDate, $endDate)
    {
        $projectGroups = ProjectGroup::where('active', true)->orderBy('id', 'asc')->get();

        return view('GenaralManager.summary.perfomance.filterDayRange', compact('startDate', 'endDate', 'projectGroups'));
    }

    public function dataTablesFilterDay($startDate, $endDate)
    {
        $query = User::select('id', 'first_name', 'last_name', 'position', 'nik')->where('active', 1)->where('dept_category_id', 6)->whereNotIn('nik', ["123456789", ""])->orderBy('first_name', 'asc')->get();
        // set_time_limit(120);

        $attendances = Attendance::with(['relationsQuest'])
            ->whereBetween('start', [$startDate, $endDate])
            ->get()
            ->groupBy('user_id');

        // Buat koleksi untuk menghitung total per grup
        $groupCounts = $attendances->map(function ($items) {
            return $items->groupBy('relationsQuest.group')->map->count();
        });

        return Datatables::of($query)
            ->addIndexColumn()
            ->addColumn('fullname', function (User $user) {
                return $user->getFullName();
            })
            ->addColumn('total', function (User $user) use ($startDate, $endDate) {
                $user->total = Attendance::with(['relationsQuest'])->where('user_id', $user->id)->whereBetween('start', [$startDate, $endDate])->whereHas('relationsQuest', function ($query) {
                    $query->where('group', '!=', null);
                })->count();

                return $user->total;
            })
            ->addColumn('column1', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][1]) ? $groupCounts[$user->id][1] : 0;
                return $group1Count;
            })
            ->addColumn('column2', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][2]) ? $groupCounts[$user->id][2] : 0;
                return $group1Count;
            })
            ->addColumn('column3', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][3]) ? $groupCounts[$user->id][3] : 0;
                return $group1Count;
            })
            ->addColumn('column4', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][4]) ? $groupCounts[$user->id][4] : 0;
                return $group1Count;
            })
            ->addColumn('column5', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][5]) ? $groupCounts[$user->id][5] : 0;
                return $group1Count;
            })
            ->addColumn('column6', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][6]) ? $groupCounts[$user->id][6] : 0;
                return $group1Count;
            })
            ->addColumn('column7', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][7]) ? $groupCounts[$user->id][7] : 0;
                return $group1Count;
            })
            ->addColumn('column8', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][8]) ? $groupCounts[$user->id][8] : 0;
                return $group1Count;
            })
            ->addColumn('column9', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][9]) ? $groupCounts[$user->id][9] : 0;
                return $group1Count;
            })
            ->addColumn('column10', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][10]) ? $groupCounts[$user->id][10] : 0;
                return $group1Count;
            })
            ->addColumn('column11', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][11]) ? $groupCounts[$user->id][11] : 0;
                return $group1Count;
            })
            ->addColumn('column12', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][12]) ? $groupCounts[$user->id][12] : 0;
                return $group1Count;
            })
            ->addColumn('column13', function (User $user) use ($groupCounts) {
                $total = $user->total;
                if ($total <= 0) {
                    return "0";
                }
                $group1Count = isset($groupCounts[$user->id][13]) ? $groupCounts[$user->id][13] : 0;
                return $group1Count;
            })
            ->make(true);
    }
}